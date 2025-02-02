<?php

namespace App\Enums;

enum HealthcareCode: int
{
    // case ไม่ระบุ = 0;
    case บัตรประกันสุขภาพ = 1;
    case ประกันสังคม = 2;
    case สิทธิข้าราชการ = 3;
    case สิทธิว่าง = 4;

    public static function options(): array
    {
        return [
            // self::ไม่ระบุ->value => 'ไม่ระบุ',
            self::บัตรประกันสุขภาพ->value => 'บัตรประกันสุขภาพ',
            self::ประกันสังคม->value => 'ประกันสังคม',
            self::สิทธิข้าราชการ->value => 'สิทธิข้าราชการ',
            self::สิทธิว่าง->value => 'สิทธิว่าง',
        ];
    }
}
