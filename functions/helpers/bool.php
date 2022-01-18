<?php

if (!function_exists('yes')) {
    function yes($val)
    {
        return in_array(mb_strtolower($val), ['yes', 'y', 'да', '1', 'true']) || $val === true || $val === 1;
    }
}

if (!function_exists('no')) {
    function no($val)
    {
        return in_array(mb_strtolower($val), ['no', 'n', 'нет', '0', 'false']) || $val === false || $val === 0;
    }
}
