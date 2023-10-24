<?php

namespace App\Helpers;

class TextHelper 
{
    public static function limitWords($text, $limit = 5) {
        $words = preg_split('/\s+/', $text);
        if (count($words) <= $limit) {
            return $text;
        } else {
            return implode(' ', array_slice($words, 0, $limit));
        }
    }
}
