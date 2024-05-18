<?php

namespace App\Enumerators;

enum Location
{
    case Home;
    case Away;
    case Neutral;

    public static function strings(): array
    {
        return array_map(fn ($location) => $location->name, Location::cases());
    }
}
