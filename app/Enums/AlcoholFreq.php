<?php

namespace App\Enums;

enum AlcoholFreq: int
{
    // case ไม่ระบุ = 0;
    case ไม่ดื่ม = 1;
    case ดื่มเมื่อเข้าสังคม = 2;
    case ดื่มเป็นประจำ = 3;

    public static function options(): array
    {
        return [
            // self::ไม่ระบุ->value => 'ไม่ระบุ',
            self::ไม่ดื่ม->value => 'ไม่ดื่ม',
            self::ดื่มเมื่อเข้าสังคม->value => 'ดื่มเมื่อเข้าสังคม',
            self::ดื่มเป็นประจำ->value => 'ดื่มเป็นประจำ',
        ];
    }
}
