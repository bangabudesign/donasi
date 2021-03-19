<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class Helper {

    public static function isActive($uri, $output = 'active')
    {
        if (\Request::is($uri,$uri.'/*')){
            return $output;
        }
    }

    public static function daysLeft($value)
    {
        $currentDate = strtotime(now());
        $val = strtotime($value);
        $distance = $val - $currentDate;
        $days = round($distance / (60 * 60 * 24));
        $hours = round(($distance % (60 * 60 * 24)) / (60 * 60));

        if ($value) {
            if ($days >= 0) {
                return $days;
            } else {
                return 0;
            }
        } else {
            return '∞';
        }
    }

    public static function truncate($text, $length, $suffix)
    {
        $text = strip_tags($text);
        $textLength = strlen($text);

        if ($textLength > $length) {
            return substr($text, 0, $length).$suffix;
        } else {
            return $text;
        }
        
    }
}