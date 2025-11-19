<?php

namespace App\Repositories;

use App\Contracts\SocialAccountRepositoryInterface;
use App\Models\SocialAccount;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SocialAccountRepository implements SocialAccountRepositoryInterface
{
    protected $model;

    public function __construct(SocialAccount $model)
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
        return $this->model
            ->paginate($perPage);
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data, UploadedFile $file)
    {
        DB::beginTransaction();

        try {
            $data['logo'] = $this->storeImage($file);
            $data['created_by'] = Auth::id();

            $data['display_order'] =
                ($this->model->max('display_order') ?? 0) + 1;

            $account = $this->model->create($data);

            DB::commit();
            return $account;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("SocialAccount creation failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function update(int $id, array $data, ?UploadedFile $file = null)
    {
        $account = $this->find($id);

        DB::beginTransaction();

        try {
            if ($file instanceof UploadedFile) {
                $this->deleteOldImage($account->logo);
                $data['logo'] = $this->storeImage($file);
            }

            $data['updated_by'] = Auth::id();

            $account->update($data);

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("SocialAccount update failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function destroy(int $id)
    {
        $account = $this->find($id);

        DB::beginTransaction();

        try {
            $this->deleteOldImage($account->logo);
            $account->delete();

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("SocialAccount deletion failed: {$e->getMessage()}");
            throw $e;
        }
    }

    private function storeImage(UploadedFile $file)
    {
        return $file->store('social_accounts', 'public');
    }

    private function deleteOldImage(?string $path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
