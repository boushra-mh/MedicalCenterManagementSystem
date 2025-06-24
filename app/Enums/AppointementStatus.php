<?php

namespace App\Enums;

enum AppointementStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'canceled';

    public function label()
    {
        return match ($this) {
            self::PENDING => 'pending',
            self::CONFIRMED => 'confirmed',
            self::CANCELLED => 'canceled',
        };
    }
}
