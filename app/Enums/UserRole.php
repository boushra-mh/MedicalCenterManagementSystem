<?php

namespace App\Enums;

use Nette\Utils\Strings;

enum UserRole:String
{
    case ADMIN ='admin';

    case DOCTOR ='doctor';
<<<<<<< HEAD
    case PATIENT = 'patient';
=======
    case USER = 'user';
>>>>>>> 3aa0de54eaf285b9a954a3013aab357c6a425dfa
    public function guard()
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::DOCTOR => 'doctor',
<<<<<<< HEAD
            self::PATIENT => 'patient',
=======
            self::USER=> 'user',
>>>>>>> 3aa0de54eaf285b9a954a3013aab357c6a425dfa
        };
    }


}
