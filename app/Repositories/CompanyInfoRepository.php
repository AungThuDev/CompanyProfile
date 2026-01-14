<?php

namespace App\Repositories;

use App\Contracts\CompanyInfoRepositoryInterface;
use App\Models\CompanyInfo;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanyInfoRepository implements CompanyInfoRepositoryInterface
{
    protected $model;

    public function __construct(CompanyInfo $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function getActive()
    {
        return $this->model->where('is_active', true)->first();
    }

    public function create(array $data, UploadedFile $file)
    {
        DB::beginTransaction();
        try {
            $data['logo'] = $file->store('company_logos', 'public');
            $data['created_by'] = Auth::id();

            $this->model->create($data);

            DB::commit();
            return;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("CompanyInfo creation failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function update(int $id, array $data, ?UploadedFile $file = null)
    {
        $companyInfo = $this->find($id);

        DB::beginTransaction();
        try {
            if ($file instanceof UploadedFile) {
                if ($companyInfo->logo && Storage::disk('public')->exists($companyInfo->logo)) {
                    Storage::disk('public')->delete($companyInfo->logo);
                }
                $data['logo'] = $file->store('company_logos', 'public');
            }

            $data['updated_by'] = Auth::id();

            $companyInfo->update($data);

            DB::commit();
            return;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("CompanyInfo update failed: {$e->getMessage()}");
            throw $e;
        }
    }

    public function destroy(int $id)
    {
        $companyInfo = $this->find($id);

        DB::beginTransaction();
        try {
            if ($companyInfo->logo && Storage::disk('public')->exists($companyInfo->logo)) {
                Storage::disk('public')->delete($companyInfo->logo);
            }

            foreach ($companyInfo->socialAccounts as $account) {
                if ($account->logo && Storage::disk('public')->exists($account->logo)) {
                    Storage::disk('public')->delete($account->logo);
                }
            }

            $companyInfo->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("CompanyInfo deletion failed: {$e->getMessage()}");
            throw $e;
        }
    }
}
