<?php

namespace App\Enums;

use ArchTech\Enums\Options;

enum SmokingFreq: int
{
    // case ไม่ระบุ = 0;
    case ไม่สูบ = 1;
    case สูบบุหรี่มวนไม่เกิน_5_มวนต่อวัน = 2;
    case สูบบุหรี่ไฟฟ้า = 3;
    case นานๆ_สูบที = 4;
    case เคยสูบแต่เลิกแล้ว = 5;
    case สูบไม่เกิน_10_มวนต่อวัน = 6;
    case สูบมากกว่า_10_มวนต่อวัน = 7;

    public static function options(): array
    {
        return [
            // self::ไม่ระบุ->value => 'ไม่ระบุ',
            self::ไม่สูบ->value => 'ไม่สูบ',
            self::สูบบุหรี่มวนไม่เกิน_5_มวนต่อวัน->value => 'สูบบุหรี่มวนไม่เกิน 5 มวน/วัน',
            self::สูบบุหรี่ไฟฟ้า->value => 'สูบบุหรี่ไฟฟ้า',
            self::นานๆ_สูบที->value => 'นานๆ สูบที',
            self::เคยสูบแต่เลิกแล้ว->value => 'เคยสูบแต่เลิกแล้ว',
            self::สูบไม่เกิน_10_มวนต่อวัน->value => 'สูบไม่เกิน 10 มวน/วัน',
            self::สูบมากกว่า_10_มวนต่อวัน->value => 'สูบมากกว่า 10 มวน/วัน',
        ];
    }
}
