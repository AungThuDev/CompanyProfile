<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug', 
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function articles()
    { 
        return $this->belongsToMany(Article::class, 'article_tags', 'tag_id', 'article_id');
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
