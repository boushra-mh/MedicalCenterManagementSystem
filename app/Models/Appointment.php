<?php

namespace App\Models;

use App\Enums\AppointementStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;
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

public function scopeFilter($query,$filter)
{
    if(!empty($filter['status']))
    {
        $query->where('status', $filter['status']);
    }
    if(!empty($filter['date']))
    {
        $query->where('date', $filter['date']);
    }
    if(!empty($filter['from_date']) && !empty($filter['to_date']) && $filter['from_date'] <= $filter['to_date'])
    {
        $query->whereBetween('date',[$filter['from_date'], $filter['to_date']]);
    }
    if(!empty($filter['time']))
    {
        $query->where('time', $filter['time']);
    }
    if(!empty($filter['doctor_id']))
    {
        $query->where('doctor_id', $filter['doctor_id']);
    }
    return $query;
}
public function scopeAppointmentsForToday($query)
{
    return $query->where('date', '=',Carbon::today()->toDateString());
}

}
