<?php

namespace App\Enums;


enum Title: int
{
    case นาย = 0;
    case นาง = 1;
    case นางสาว = 2;

    public static function options(): array
    {
        return [
            self::นาย->value => 'นาย',
            self::นาง->value => 'นาง',
            self::นางสาว->value => 'นางสาว',
        ];
    }
}
