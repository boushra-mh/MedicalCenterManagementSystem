<?php

namespace App\Models;

use App\Enums\AppointementStatus;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
protected $fillable = ['user_id','doctor_id','date','time','status'];
protected $casts = ['status'=>AppointementStatus::class];
public function doctor()
{
    return $this->belongsTo(Doctor::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
}
