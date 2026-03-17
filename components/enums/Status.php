<?php
namespace app\components\enums;

enum Status: int
{
    case WAIT = 0;
    case APPROVED = 1;
    case DECLINED = 2;

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
