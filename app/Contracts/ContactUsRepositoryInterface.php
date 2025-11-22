<?php

namespace App\Contracts;

interface ContactUsRepositoryInterface
{
    public function create(array $data);

    public function all();

    public function paginate($perPage = 10);

    public function find($id);
}
