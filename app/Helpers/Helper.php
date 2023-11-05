<?php

use Carbon\Carbon;

if (! function_exists('limitWords')) {
    function limitWords($text, $limit = 5)
    {
        $words = preg_split('/\s+/', $text);
        $ellipsis = '...';
        if (count($words) <= $limit) {
            return $text;
        } else {
            $limitedWords = implode(' ', array_slice($words, 0, $limit));

            return $limitedWords.$ellipsis;
        }
    }
}

if (! function_exists('formatCreatedAt')) {
    function formatCreatedAt($text, $limit = 5)
    {
        $originalDate = "2023-03-29 15:15:30";
        return Carbon::parse($originalDate)->format('F d, Y');
    }
}
