<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface ArticleRepositoryInterface
{
    public function all();

    public function paginate(int $perPage = 10);

    public function find(int $id);

    public function create(array $data, array $tagIds = [], ?UploadedFile $file = null);

    public function update(int $id, array $data, array $tagIds = [], ?UploadedFile $file = null);

    public function destroy(int $id);
}
