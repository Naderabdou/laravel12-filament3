<?php

namespace App\Enums;

enum BlogType: string
{
    case BLOG = 'blog';
    case NEWS = 'news';


    public function label(): string
    {
        return match ($this) {
            self::BLOG => 'مدونة',
            self::NEWS => 'اخبار',
        };
    }

}
