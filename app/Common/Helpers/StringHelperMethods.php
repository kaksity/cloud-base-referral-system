<?php

function generateRandomString($length = 10)
{
    return substr(str_shuffle('123456789ABCDEFGHIJKLMPQRSTUWXYZ'), 0, $length);
}

function generateRandomNumber($count = 8)
{
    return substr(str_shuffle('1234567890'), 0, $count);
}

function ellipsis($longString, $maxCharacter = 30)
{
    $longString  = strip_tags($longString);
    $short_string = strlen($longString) > $maxCharacter ? mb_substr($longString, 0, $maxCharacter) . "..." : $longString;
    return $short_string;
}
