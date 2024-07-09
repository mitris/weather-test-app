<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum BeaufortScale: string
{
    case CALM = 'Calm';
    case LIGHT_AIR = 'Light air';
    case LIGHT_BREEZE = 'Light breeze';
    case GENTLE_BREEZE = 'Gentle breeze';
    case MODERATE_BREEZE = 'Moderate breeze';
    case FRESH_BREEZE = 'Fresh breeze';
    case STRONG_BREEZE = 'Strong breeze';
    case NEAR_GALE = 'Near gale';
    case GALE = 'Gale';
    case STRONG_GALE = 'Strong gale';
    case STORM = 'Storm';
    case VIOLENT_STORM = 'Violent storm';
    case HURRICANE = 'Hurricane';

    public static function fromName(string $name): string
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status->value;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum " . self::class);
    }

    public static function tryFromName(string $name): string|null
    {
        try {
            return self::fromName($name);
        } catch (\ValueError $error) {
            return null;
        }
    }

    public static function getNameByWindSpeed(?float $v): ?string
    {
        return match (true) {
            $v < 1 => self::CALM->name,
            $v >= 1 && $v <= 5 => self::LIGHT_AIR->name,
            $v >= 6 && $v <= 11 => self::LIGHT_BREEZE->name,
            $v >= 12 && $v <= 19 => self::GENTLE_BREEZE->name,
            $v >= 20 && $v <= 28 => self::MODERATE_BREEZE->name,
            $v >= 29 && $v <= 38 => self::FRESH_BREEZE->name,
            $v >= 39 && $v <= 49 => self::STRONG_BREEZE->name,
            $v >= 50 && $v <= 61 => self::NEAR_GALE->name,
            $v >= 62 && $v <= 74 => self::GALE->name,
            $v >= 75 && $v <= 88 => self::STRONG_GALE->name,
            $v >= 89 && $v <= 102 => self::STORM->name,
            $v >= 103 && $v <= 117 => self::VIOLENT_STORM->name,
            $v >= 118 => self::HURRICANE->name,
            default => 'Unknown',
        };
    }

    public static function getColor($v)
    {
        return match ($v) {
            self::CALM->name => '#b3dfeb',
            self::LIGHT_AIR->name => '#93d9ed',
            self::LIGHT_BREEZE->name => '#77d3ee',
            self::GENTLE_BREEZE->name => '#4bc4e9',
            self::MODERATE_BREEZE->name => '#1db9ec',
            self::FRESH_BREEZE->name => '#0fafdf',
            self::STRONG_BREEZE->name => '#0461e3',
            self::NEAR_GALE->name => '#0a4db4',
            self::GALE->name => '#6e0dc2',
            self::STRONG_GALE->name => '#c00cb6',
            self::STORM->name => '#c20c4d',
            self::VIOLENT_STORM->name => '#de520c',
            self::HURRICANE->name => '#ee8d0d',
            default => 'Unknown',
        };
    }
}
