<?php

namespace App\Repositories;

use Exception;
use App\Models\ContactUs;
use App\Contracts\ContactUsRepositoryInterface;

class ContactUsRepository implements ContactUsRepositoryInterface
{
    protected $model;

    public function __construct(ContactUs $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        try {
            $this->model->create($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
