<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 */
final class MemberLevel extends Enum
{
    const NORMAL = 'normal';
    const SENIOR = 'senior';

    /**
     * @param mixed $value
     * @return string
     */
    public static function getDescription($value): string
    {
        if ($value === self::NORMAL) {
            $description = '普通会员'; // 普通会员不能发布内容
        } elseif ($value === self::SENIOR) {
            $description = '高级会员'; // 高级会员可以发布内容
        } else {
            $description = parent::getDescription($value);
        }

        return $description;
    }
}
