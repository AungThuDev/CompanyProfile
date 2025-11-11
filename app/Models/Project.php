<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_type_id',
        'title', 
        'slug', 
        'image', 
        'description',
        'project_url',
        'start_date', 
        'end_date', 
        'display_order', 
        'created_by',
        'updated_by',
    ];

    public function projectType()
    { 
        return $this->belongsTo(ProjectType::class);
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
