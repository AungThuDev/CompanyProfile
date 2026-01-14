<?php

namespace App\Repositories;

use App\Contracts\TagRepositoryInterface;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TagRepository implements TagRepositoryInterface
{
    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate(int $perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $data['slug'] = Str::slug($data['name']);
            $data['created_by'] = Auth::id();

            $this->model->create($data);

            DB::commit();
            return;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Tag creation failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function update(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $tag = $this->find($id);

            if (isset($data['name']) && $data['name'] !== $tag->name) {
                $data['slug'] = Str::slug($data['name']);
            }

            $data['updated_by'] = Auth::id();

            $tag->update($data);

            DB::commit();
            return;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Tag update failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function destroy(int $id)
    {
        DB::beginTransaction();

        try {
            $tag = $this->find($id);
            $tag->delete();

            DB::commit();
            return;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Tag deletion failed: {$e->getMessage()}");
            throw $e;
        }
    }
}
