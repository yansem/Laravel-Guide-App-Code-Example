<?php

namespace App\Services\Program;

use Illuminate\Support\Str;

class SearchService
{
    public function matchText(string $q, string $text): string
    {
        $charCount = 50;
        $q = preg_quote(htmlspecialchars($q), '/');
        $text = htmlspecialchars($text);
        preg_match("/$q/iu", $text, $match);
        $replace = '<b class="text-black">' . $match[0] . '</b>';
        $sliceAfter = Str::after($text, $match[0]);
        $sliceAfter = mb_strlen($sliceAfter, 'utf-8') > $charCount ? mb_substr($sliceAfter, 0, $charCount, 'utf-8') . "..." : $sliceAfter;
        $sliceBefore = Str::before($text, $match[0]);
        $sliceBefore = mb_strlen($sliceBefore, 'utf-8') > $charCount ? "..." . mb_substr($sliceBefore, -$charCount, $charCount, 'utf-8') : $sliceBefore;
        $resultStr = $sliceBefore . $match[0] . $sliceAfter;
        return str_replace($match[0], $replace, $resultStr);
    }
}
