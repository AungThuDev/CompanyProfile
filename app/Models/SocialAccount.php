<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'icon_url',
        'account_link',
        'description',
        'display_order',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function company()
    {
        return $this->belongsTo(CompanyInfo::class, 'company_id');
    }

	public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

	public function updator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
