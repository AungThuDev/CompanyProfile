<?php

namespace App\Contracts\Backend;

use Illuminate\Http\UploadedFile;

interface ProjectRepositoryInterface
{
    public function all();
    public function paginate(int $perPage = 10);

    public function find(int $id);

    public function create(array $data, UploadedFile $file);

    public function update(int $id, array $data, ?UploadedFile $file = null);

    public function destroy(int $id);
}
