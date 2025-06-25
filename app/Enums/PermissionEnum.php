<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case MANAGE_SPECIALTIES = 'manage_specialties';
    case MANAGE_DOCTORS = 'manage_doctors';
    case VIEW_APPOINTMENT = 'view_appointment';
    case BOOK_APPOINTMENT = 'book_appointment';

    public function guard()
    {
        return match ($this) {
            self::MANAGE_SPECIALTIES, self::MANAGE_DOCTORS => 'admin',
            self::VIEW_APPOINTMENT => 'doctor',
            self::BOOK_APPOINTMENT => 'user',
        };
    }
}
