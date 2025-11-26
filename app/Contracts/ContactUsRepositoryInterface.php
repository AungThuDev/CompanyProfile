<?php

namespace App\Contracts;

interface ContactUsRepositoryInterface
{
    public function all();

    public function paginate(int $perPage = 10);

    public function find(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function destroy(int $id);

    public function addReply(int $contactId, array $data);
}
