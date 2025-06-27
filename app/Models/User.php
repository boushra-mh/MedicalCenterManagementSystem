<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
<<<<<<< HEAD
=======

>>>>>>> 3aa0de5 (SpecialtiesPanel)

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
<<<<<<< HEAD
    use HasFactory, Notifiable, HasRoles, HasApiTokens;
=======
    use HasFactory, Notifiable,HasRoles,HasApiTokens;
>>>>>>> 3aa0de5 (SpecialtiesPanel)

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

<<<<<<< HEAD
    protected $guard_name = 'user';

=======
        protected $guard_name = 'user';
>>>>>>> 3aa0de5 (SpecialtiesPanel)
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
<<<<<<< HEAD

=======
>>>>>>> 3aa0de5 (SpecialtiesPanel)
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
