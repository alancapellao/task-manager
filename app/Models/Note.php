<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public static $maxNotes = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'content',
        'user_id',
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

    protected static function booted()
    {
        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', auth()->id());
        });
    }
}
