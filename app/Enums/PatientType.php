<?php

namespace App\Enums;

enum PatientType: int
{
    case บุคคลทั่วไป = 0;

    public static function options(): array
    {
        return [
            self::บุคคลทั่วไป->value => 'บุคคลทั่วไป',
        ];
    }
}
