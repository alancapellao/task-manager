<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'avatar',
    ];

    protected $attributes = [
        'is_active' => true,
        'is_admin' => false,
        'language' => null,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'id',
        'is_active',
        'is_admin',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setDefaultLanguage();
    }

    public function settings()
    {
        return $this->hasOne(Settings::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    private function setDefaultLanguage()
    {
        $locale = config('app.locale');

        $acceptedLanguages = request()->server('HTTP_ACCEPT_LANGUAGE');

        $preferredLanguages = explode(',', $acceptedLanguages);

        $this->attributes['language'] = $preferredLanguages[0] ?? $locale;
    }
}
