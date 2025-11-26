<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read',
        'ip_address',
    ];

    public function replies(): HasMany
    {
        return $this->hasMany(ContactReply::class, 'contact_us_id');
    }

    public function latestReply()
    {
        return $this->hasOne(ContactReply::class, 'contact_us_id')->latestOfMany();
    }
}
