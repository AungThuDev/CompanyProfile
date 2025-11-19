<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface CompanyInfoRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function getActive();
    public function create(array $data, UploadedFile $file);
    public function update(int $id, array $data, ?UploadedFile $file = null);
    public function destroy(int $id);
}
