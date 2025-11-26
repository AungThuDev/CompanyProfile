<?php

namespace App\Repositories;

use App\Contracts\ContactUsRepositoryInterface;
use App\Models\ContactUs;
use App\Models\ContactReply;
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
        return $this->model->with('replies')->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->model->with('replies')->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->with(['replies' => function($query) {
            $query->with('repliedBy')->orderBy('created_at', 'desc');
        }])->findOrFail($id);
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

    public function addReply(int $contactId, array $data)
    {
        DB::beginTransaction();

        try {
            $contact = $this->find($contactId);
            
            $reply = ContactReply::create([
                'contact_us_id' => $contactId,
                'message' => $data['message'],
                'replied_by' => $data['replied_by'] ?? null,
            ]);

            DB::commit();
            return $reply;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Contact reply creation failed: {$e->getMessage()}");
            throw $e;
        }
    }
}
