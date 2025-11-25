<?php

namespace App\Repositories;

use App\Contracts\ContactUsRepositoryInterface;
use App\Models\ContactUs;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $contact = $this->model->create($data);

            DB::commit();
            return $contact;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Contact creation failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();

        try {
            $contact = $this->find($id);
            $contact->update($data);

            DB::commit();
            return $contact;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Contact update failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $contact = $this->find($id);
            $contact->delete();

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Contact deletion failed: {$e->getMessage()}");
            throw $e;
        }
    }
}
