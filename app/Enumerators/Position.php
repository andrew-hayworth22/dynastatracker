<?php

namespace App\Enumerators;

enum Position: int
{
    case Quarterback = 1;
    case Halfback = 2;
    case Fullback = 3;
    case Wide_Receiver = 4;
    case Tight_End = 5;
    case Tackle = 6;
    case Guard = 7;
    case Center = 8;
    case Defensive_Tackle = 9;
    case Left_End = 10;
    case Right_End = 11;
    case Outside_Linebacker = 12;
    case Middle_Linebacker = 13;
    case Cornerback = 14;
    case Strong_Safety = 15;
    case Free_Safety = 16;
    case Kicker = 17;
    case Punter = 18;

    public static function beautified_list(): array
    {
        return array_map(fn ($position) => $position->beautified(), self::cases());
    }

    public function beautified(): object {
        return (object) [
            'name' => str_replace('_', ' ', $this->name),
            'value' => $this->value,
        ];
    }
}
