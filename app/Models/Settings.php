<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'theme',
        'language',
        'user_id'
    ];

    protected $attributes = [
        'theme' => 'light',
        'notification' => true,
        'language' => 'en',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
