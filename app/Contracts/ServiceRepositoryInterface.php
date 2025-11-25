<?php 

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface ServiceRepositoryInterface
{
    public function all();

    public function paginate(int $perPage = 10);

    public function getTopServices(int $limit = 6);

    public function find(int $id);

    public function create(array $data, UploadedFile $icon);

    public function update(int $id, array $data, ?UploadedFile $icon = null);

    public function destroy(int $id);
}
