<?php

namespace App\Contracts\Backend;

use Illuminate\Http\UploadedFile;

interface UserRepositoryInterface
{
    public function findById(int $id);

    public function updateProfileWithImage(int $id, array $data, ?UploadedFile $file): bool;
}
