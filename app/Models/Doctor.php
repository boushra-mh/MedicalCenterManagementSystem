<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory;
    protected $fillable = ['name','email','password'];

    public function specialties()
    {
        return $this->hasMany(Specialty::class);
    }
    public function appointements()
    {
        return $this->hasMany(Appointment::class);
    }
}
