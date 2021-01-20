<?php


namespace app\helpers;


class StringHelper
{
public static function ltrim($subject, $separator = ''){
    return ltrim($subject, " \t\n\r\0\x0B{$separator}");
}

}