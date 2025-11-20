<?php

namespace App\Repositories;

use App\Contracts\ServiceRepositoryInterface;
use App\Models\Service;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceRepository implements ServiceRepositoryInterface
{
    protected $model;

    public function __construct(Service $model)
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

    public function getTopServices(int $limit = 6)
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
            $data['slug'] = $this->generateSlug($data['title']);
            $data['image'] = $this->storeImage($file);
            $data['created_by'] = Auth::id();

            $data['display_order'] = ($this->model->max('display_order') ?? 0) + 1;

            $service = $this->model->create($data);

            DB::commit();
            return $service;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Service creation failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function update(int $id, array $data, ?UploadedFile $file = null)
    {
        $service = $this->find($id);

        DB::beginTransaction();

        try {
            if ($file instanceof UploadedFile) {
                $this->deleteOldImage($service->image);
                $data['image'] = $this->storeImage($file);
            } else {
                unset($data['image']);
            }

            if (isset($data['title']) && $data['title'] !== $service->title) {
                $data['slug'] = $this->generateSlug($data['title']);
            }

            $data['updated_by'] = Auth::id();

            $service->update($data);

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Service update failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function destroy(int $id)
    {
        $service = $this->find($id);

        DB::beginTransaction();

        try {
            $this->deleteOldImage($service->image);
            $service->delete();

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Service deletion failed: {$e->getMessage()}");
            throw $e;
        }
    }

    private function generateSlug(string $title)
    {
        return Str::slug($title);
    }

    private function storeImage(UploadedFile $file)
    {
        return $file->store('services', 'public');
    }

    private function deleteOldImage(?string $path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
