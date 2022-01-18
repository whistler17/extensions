<?php

namespace Itgro;

class Cookie
{
    const DEFAULT_COOKIE_TTL = 60 * 60 * 24 * 60;

    public static function set($code, $value, $expire = self::DEFAULT_COOKIE_TTL, $path = '/', $domain = '')
    {
        self::remove($code);

        setcookie($code, $value, time() + $expire, $path, $domain);
    }

    public static function get($code)
    {
        return $_COOKIE[$code];
    }

    public static function remove($code, $path = '/', $domain = '')
    {
        setcookie($code, '', $path, $domain);
    }
}
