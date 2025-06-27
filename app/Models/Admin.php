<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */

    use HasFactory ,HasRoles,HasApiTokens;
    protected $fillable = ['name','email','password'];

protected $guard_name = 'admin';
}


