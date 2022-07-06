<?php

namespace Resources;

class EquipmentRequestHelper
{
    /**
     * @param string $serial
     * @param string $mask
     * @return bool
     */
    public function checkSerialMask (string $serial, string $mask): bool
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
    }

    /**
     * @param string $value
     * @return array
     */
    function getFormattedJsonString(string $value): array
    {
        $valueReplaced = str_replace("'", '"', $value);
        return json_decode($valueReplaced, true);
    }
}
