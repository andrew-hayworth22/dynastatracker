<?php

namespace App\Enumerators;

enum Grade: int
{
    case FR = 1;
    case FR_RS = 2;
    case SO = 3;
    case SO_RS = 4;
    case JR = 5;
    case JR_RS = 6;
    case SR = 7;
    case SR_RS = 8;

    public static function beautified_list(): array
    {
        return array_map(function ($grade) {
            return $grade->beautified();
        }, self::cases());
    }

    public function beautified(): object {
        return (object) [
            'name' => str_contains($this->name, '_') ? (str_replace('_', ' (', $this->name) . ')') : $this->name,
            'value' => $this->value,
        ];
    }
}

