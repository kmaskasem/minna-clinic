<?php

namespace App\Enums;

enum Gender: int
{
    case ชาย = 0;
    case หญิง = 1;

    public static function options(): array
    {
        return [
            self::ชาย->value => 'ชาย',
            self::หญิง->value => 'หญิง',
        ];
    }
}
