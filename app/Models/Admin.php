<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
=======
>>>>>>> 3aa0de5 (SpecialtiesPanel)

class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
<<<<<<< HEAD
    use HasFactory,HasApiTokens,HasRoles ;
    protected $fillable = ['name','email','password'];



=======
    use HasFactory ,HasRoles,HasApiTokens;
    protected $fillable = ['name','email','password'];
>>>>>>> 3aa0de5 (SpecialtiesPanel)
protected $guard_name = 'admin';
}


