<?php

namespace App\Contracts\Backend;

use Illuminate\Http\UploadedFile;

interface UserRepositoryInterface
{
    public function all();

    public function paginate(int $perPage = 10);
    
    public function findById(int $id);

    public function updateProfileWithImage(int $id, array $data, ?UploadedFile $file): bool;

    public function create(array $data);
}
