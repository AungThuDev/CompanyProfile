<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_info_id',
        'name',
        'logo',
        'account_link',
        'display_order',
    ];

    public function companyInfo()
    {
        return $this->belongsTo(CompanyInfo::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
