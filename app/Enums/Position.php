<?php

namespace App\Enums;


enum Position: int
{
    case ข้าราชการ = 0;
    case พนักงานมธ = 1;
    case ลูกจ้างประจำ = 2;
    case ลูกจ้างชั่วคราว = 3;
    case แม่บ้าน = 4;
    case รปภ = 5;

    public static function options(): array
    {
        return [
            self::ข้าราชการ->value => 'ข้าราชการ',
            self::พนักงานมธ->value => 'พนักงานมธ',
            self::ลูกจ้างประจำ->value => 'ลูกจ้างประจำ',
            self::ลูกจ้างชั่วคราว->value => 'ลูกจ้างชั่วคราว',
            self::แม่บ้าน->value => 'แม่บ้าน',
            self::รปภ->value => 'รปภ.',
        ];
    }
}
