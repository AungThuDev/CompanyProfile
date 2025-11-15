<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    protected function deleteOldProfile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function updateProfileWithImage(int $id, array $data, ?UploadedFile $file): bool
    {
        $user = $this->findById($id);

        DB::beginTransaction();

        try {
            // Handle profile image if uploaded
            if ($file instanceof UploadedFile) {
                $this->deleteOldProfile($user->profile);
                $data['profile'] = $file->store('profiles', 'public');
            } else {
                unset($data['profile']);
            }

            $updated = $user->update($data);

            DB::commit();

            return $updated;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to update user profile: {$e->getMessage()}");
            throw $e;
        }
    }
}