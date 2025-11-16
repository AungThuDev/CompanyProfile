<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\ProjectTypeRepositoryInterface;
use App\Models\ProjectType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class ProjectTypeRepository implements ProjectTypeRepositoryInterface
{
    protected ProjectType $model;

    public function __construct(ProjectType $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model
            ->all();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $data['slug'] = $this->generateSlug($data['name']);
            $data['created_by'] = Auth::id();

            $data['display_order'] = ($this->model->max('display_order') ?? 0) + 1;

            $projectType = $this->model->create($data);

            DB::commit();
            return $projectType;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("ProjectType creation failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function update(int $id, array $data)
    {
        $projectType = $this->find($id);
        DB::beginTransaction();
        try {
            if (isset($data['name']) && $data['name'] !== $projectType->name) {
                $data['slug'] = $this->generateSlug($data['name']);
            }

            $data['updated_by'] = Auth::id();
            $projectType->update($data);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("ProjectType update failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function destroy(int $id)
    {
        $projectType = $this->find($id);
        DB::beginTransaction();
        try {
            $projectType->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("ProjectType deletion failed: {$e->getMessage()}");
            throw $e;
        }
    }

    private function generateSlug(string $name)
    {
        return Str::slug($name);
    }
}
