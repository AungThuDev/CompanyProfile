<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'name',
        'email',
        'phone',
        'address',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class)->orderBy('display_order', 'asc');
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
