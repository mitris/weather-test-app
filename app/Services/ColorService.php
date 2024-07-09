<?php

namespace App\Services;

class ColorService
{

    public function hexToRgb($hex)
    {
        $hex = str_replace('#', '', $hex);

        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 4));
        $b = hexdec(substr($hex, 4, 6));

        return [$r, $g, $b];
    }

    public function rgbToHex($r, $g, $b)
    {
        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    public function invertColor($hex)
    {
        list($r, $g, $b) = $this->hexToRgb($hex);
        $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;

        return ($brightness > 128) ? '#000000' : '#FFFFFF';
    }

    public function invertColorRGB($hex)
    {
        list($r, $g, $b) = $this->hexToRgb($hex);

        $r = 255 - $r;
        $g = 255 - $g;
        $b = 255 - $b;

        return "rgb($r, $g, $b)";
    }
}
