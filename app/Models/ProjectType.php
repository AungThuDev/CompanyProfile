<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug', 
        'description',
        'display_order',
        'created_by', 
        'updated_by',
    ];

    public function projects()
    { 
        return $this->hasMany(Project::class);
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
