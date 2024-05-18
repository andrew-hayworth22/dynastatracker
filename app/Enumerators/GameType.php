<?php

namespace App\Enumerators;

enum GameType: string
{
    case RegularSeason = 'Regular Season';
    case ConferenceChampionship = 'Conference Championship';
    case BowlGame = 'Bowl Game';
    case NationalOctafinals = 'National Octafinals';
    case NationalQuarterfinals = 'National Quarterfinals';
    case NationalSemifinals = 'National Semifinals';
    case NationalChampionship = 'National Championship';

    public static function strings(): array
    {
        return array_map(fn ($type) => $type->value, GameType::cases());
    }
}
