<?php

namespace App\Enumerators;

enum CoachType
{
    case OC;
    case DC;
    case HC;

    public static function strings(): array
    {
        return array_map(fn ($type) => $type->name, CoachType::cases());
    }
}
