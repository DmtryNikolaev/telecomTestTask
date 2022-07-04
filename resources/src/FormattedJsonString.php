<?php

/**
 * @param $value
 * @return mixed
 */
function getFormattedJsonString($value)
{
    $valueReplaced = str_replace("'", '"', $value);
    return json_decode($valueReplaced, true);
}
