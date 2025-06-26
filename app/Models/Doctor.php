<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Doctor extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory ,HasRoles ,HasApiTokens;
    protected $guard_name = 'doctor';

    protected $fillable = ['name','email','password'];

    public function specialties()
    {

        return $this->belongsToMany(Specialty::class);
    }
 
    public function appointments()

    {
        return $this->hasMany(Appointment::class);
    }
}
