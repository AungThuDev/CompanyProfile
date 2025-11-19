<?php 

namespace App\Contracts;

interface CategoryRepositoryInterface
{
     public function all();
     public function find(int $id);
     public function paginate(int $perPage = 10);
     public function create(array $data);
     public function update(int $id, array $data);
     public function destroy(int $id);
}