<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_us_id',
        'message',
        'replied_by',
    ];

    public function contactUs(): BelongsTo
    {
        return $this->belongsTo(ContactUs::class, 'contact_us_id');
    }

    public function repliedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_by');
    }
}
