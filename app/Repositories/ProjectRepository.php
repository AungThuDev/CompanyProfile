<?php

namespace App\Repositories;

use App\Contracts\ProjectRepositoryInterface;
use App\Models\Project;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectRepository implements ProjectRepositoryInterface
{
    protected $model;

    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model
            ->all();
    }

    public function paginate(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function getTopProjects(int $limit = 6)
    {
        return $this->model
            ->orderBy('display_order', 'asc')
            ->limit($limit)
            ->get();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data, UploadedFile $file)
    {
        DB::beginTransaction();

        try {
            $data['slug'] = Str::slug($data['title']);
            $data['image'] = $this->storeImage($file);
            $data['created_by'] = Auth::id();

            $data['display_order'] = ($this->model->max('display_order') ?? 0) + 1;

            $project = $this->model->create($data);

            DB::commit();
            return $project;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Project creation failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function update(int $id, array $data, ?UploadedFile $file = null)
    {
        $project = $this->find($id);

        DB::beginTransaction();

        try {
            if ($file instanceof UploadedFile) {
                $this->deleteOldImage($project->image);
                $data['image'] = $this->storeImage($file);
            }

            if (isset($data['title']) && $data['title'] !== $project->title) {
                $data['slug'] = Str::slug($data['title']);
            }

            $data['updated_by'] = Auth::id();

            $project->update($data);

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Project update failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function destroy(int $id)
    {
        $project = $this->find($id);

        DB::beginTransaction();

        try {
            $this->deleteOldImage($project->image);
            $project->delete();

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Project deletion failed: {$e->getMessage()}");
            throw $e;
        }
    }

    private function storeImage(UploadedFile $file)
    {
        return $file->store('projects', 'public');
    }

    private function deleteOldImage(?string $path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
