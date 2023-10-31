<?php

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
