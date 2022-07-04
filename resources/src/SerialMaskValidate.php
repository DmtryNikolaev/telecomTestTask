<?php

namespace Resources\SerialMaskValidate;

/**
 * @param $serial
 * @param $mask
 * @return bool
 */
function checkSerialMask ($serial, $mask)
{
    if (strlen($serial) != strlen($mask))
        return false;

    $regx = [
        "N" => "[0-9]",
        "A" => "[A-Z]",
        "a" => "[a-z]",
        "X" => "[A-Z0-9]",
        "Z" => "[-|_|@]"
    ];

    $maskChars = str_split($mask);
    $outputRegex = "/^";
    foreach ($maskChars as $char) {
        $outputRegex .= $regx[$char];
    }
    $outputRegex .= "/";

    return (preg_match($outputRegex, $serial) > 0 ? true: false);
};
