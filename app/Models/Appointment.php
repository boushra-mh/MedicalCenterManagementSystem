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


public function scopeConfirmed($query)
{
    return $query->where('status', AppointementStatus::CONFIRMED->value);
}

public function scopePending($query)
{
    return $query->where('status', AppointementStatus::PENDING->value);
}

public function scopeCanceled($query)
{
    return $query->where('status', AppointementStatus::CANCELLED->value);
}

public function scopeByUser($query,$user_id)
{
    return $query->where('user_id',$user_id);
   
}
public function scopeByDoctor($query,$doctor_id)
{
    return $query->where('doctor_id',$doctor_id);
}

}
