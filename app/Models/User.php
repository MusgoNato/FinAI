<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Criado virtualmente, colocando profile_image o Laravel tenta acessar a função correspondente a isso, como não existe no
    // meu model ele da erro de função não conhecida. Somente lembrando que o Laravel vai executar essa logica somente se o model virar JSON
    // em algum momento da aplicação
    protected $appends = ['profile_image_url', 'created_at_formatted'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'has_local_password',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getProfileImageUrlAttribute()
    {
        if($this->profile_image)
        {
            return Storage::url($this->profile_image);
        }

        return asset('storage/profile_images/default-avatar.png');
    }

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }
}
