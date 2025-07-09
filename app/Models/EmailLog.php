<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = ['to_email', 'subject', 'body', 'emailable_type', 'emailable_id'];

    public function emailable()
    {
        return $this->morphTo();
    }
}
