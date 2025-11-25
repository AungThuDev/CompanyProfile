<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read',
        'replied_at',
        'reply_message',     
        'replied_by',
        'ip_address',
    ];

    protected $casts = [ 
        'replied_at' => 'datetime',
    ];

	public function repliedBy(): BelongsTo
	{
		return $this->belongsTo(User::class, 'replied_by');
	}
}
