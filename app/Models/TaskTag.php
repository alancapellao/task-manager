<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTag extends Model
{
    use HasFactory;

    protected $table = 'tasks_tags';

    protected $fillable = [
        'task_id',
        'tag_id',
    ];

    protected $casts = [
        'task_id' => 'integer',
        'tag_id' => 'integer',
    ];

    public $timestamps = false;

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
