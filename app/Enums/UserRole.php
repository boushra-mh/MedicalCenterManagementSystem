<?php

namespace App\Enums;

use Nette\Utils\Strings;

enum UserRole:String
{
    case ADMIN ='admin';

    case DOCTOR ='doctor';
    case PATIENT = 'patient';
    public function guard()
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::DOCTOR => 'doctor',
            self::PATIENT => 'patient',
        };
    }


}
