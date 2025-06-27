<?php

namespace App\Enums;

use Nette\Utils\Strings;

enum UserRole:String
{
    case ADMIN ='admin';

    case DOCTOR ='doctor';
<<<<<<< HEAD

=======
>>>>>>> 3aa0de5 (SpecialtiesPanel)
    case USER = 'user';
    public function guard()
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::DOCTOR => 'doctor',
<<<<<<< HEAD
            self::USER=> 'user'
=======
            self::USER=> 'user',
>>>>>>> 3aa0de5 (SpecialtiesPanel)
        };
    }


}
