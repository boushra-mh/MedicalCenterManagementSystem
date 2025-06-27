<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> 3aa0de5 (SpecialtiesPanel)
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

<<<<<<< HEAD

=======
>>>>>>> 3aa0de5 (SpecialtiesPanel)
class Doctor extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory ,HasRoles ,HasApiTokens;
    protected $guard_name = 'doctor';
<<<<<<< HEAD

=======
>>>>>>> 3aa0de5 (SpecialtiesPanel)
    protected $fillable = ['name','email','password'];

    public function specialties()
    {
<<<<<<< HEAD

        return $this->belongsToMany(Specialty::class);
    }
 
    public function appointments()

=======
        return $this->belongsToMany(Specialty::class);
    }
    public function appointments()
>>>>>>> 3aa0de5 (SpecialtiesPanel)
    {
        return $this->hasMany(Appointment::class);
    }
}
