<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public static $page = 15;

    public static $status = [
        0 => 'to-do',
        1 => 'in-progress',
        2 => 'done',
    ];

    protected $fillable = [
        'title',
        'description',
        'completed_at',
        'lista_id',
        'due_date',
        'priority',
        'status',
        'user_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'lista_id' => 'integer',
        'completed_at' => 'datetime',
        'deleted_at' => 'datetime',
        'priority' => 'integer',
        'status' => 'integer',
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $attributes = [
        'priority' => 0,
        'status' => 0,
    ];

    public function lista()
    {
        return $this->belongsTo(Lista::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tasks_tags', 'task_id', 'tag_id');
    }

    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('due_date', 'desc');
            $query->orderBy('id', 'desc');
        });

        static::addGlobalScope('status', function ($query) {
            $query->whereIn('status', array_keys(static::$status));
        });

        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', auth()->id());
        });

        static::addGlobalScope('lista_id', function ($query) {
            $query->whereIn('lista_id', function ($query) {
                $query->select('id')->from('listas')->where('user_id', auth()->id());
            });
        });
    }

    public function scopeFormattedDueDate($query)
    {
        return $query->selectRaw('*, DATE_FORMAT(due_date, "%d/%m/%Y") as formatted_due_date');
    }
}
