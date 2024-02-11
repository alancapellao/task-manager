<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'color',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('name', 'asc');
        });

        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', auth()->id());
        });
    }
}
