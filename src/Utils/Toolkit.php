<?php

namespace Litehex\MerchantSDK\Utils;

/**
 * Toolkit class
 *
 * @link    https://github.com/litehex/merchant-sdk-php
 * @author  Shahrad Elahi <shahrad@litehex.com>
 * @license MIT
 */
class Toolkit
{

    /**
     * Generate a random string, using a cryptographically secure
     *
     * @param int $length
     * @return string
     */
    public static function randomString(int $length = 10): string
    {
        return substr(
            str_shuffle(
                str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))),
            1,
            $length
        );
    }

    /**
     * Check is given string is a valid JSON string.
     *
     * @param string $string
     * @return bool
     */
    public static function isJson(string $string): bool
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * Get the current timestamp in milliseconds.
     *
     * @return int
     */
    public static function getTimestamp(): int
    {
        return (int) (microtime(true) * 1000);
    }

}