<?php
namespace App\Library;

class Utility
{
    public static function implodeWithKeys($glue, $array, $symbol = '=')
    {
        return implode($glue,
            array_map(
                function($k, $v) use($symbol) {
                    return $k . $symbol . $v;
                },
                array_keys($array),
                array_values($array)
            )
        );
    }
}
