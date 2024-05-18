<?php

namespace App\Enumerators;

enum Coverage
{
    case None;
    case Regional;
    case National;

    public static function strings(): array
    {
        return array_map(fn ($coverage) => $coverage->name, Coverage::cases());
    }
}
