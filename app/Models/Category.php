<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'parent_id', 
        'name', 
        'slug', 
        'description', 
        'is_active',
        'created_by', 
        'updated_by',
    ];

    public function articles()
    { 
        return $this->hasMany(Article::class);
    }

    public function parent()
    { 
        return $this->belongsTo(Category::class, 'parent_id');
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
