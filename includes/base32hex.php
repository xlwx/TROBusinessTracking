<?php
/**
 * This file is part of the Util package.
 *
 * (c) 2014 Tomas Chvostek <kokso@vinnemusky.sk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
//namespace Koksosk;

/**
 * Base32Hex class - encodes and decodes string to/from Base32hex
 *
 * Last update: 2014-10-07
 *
 * RFC 2938 compliant
 * @link http://tools.ietf.org/rfc/rfc2938
 *
 * @author Tomas Chvostek
 * @package Utils
 */
class Base32Hex
{
    /**
     * Number of bits stored in base32hex alphabet values
     *
     * @var int
     */
    protected static $base32HexBits = 5;

    /**
     * Base32hex lookup alphabet [wiki link](http://en.wikipedia.org/wiki/Base32#base32hex)
     *
     * @var array
     */
    protected static $base32HexAlphabet = array(
        "0" => "00000",
        "1" => "00001",
        "2" => "00010",
        "3" => "00011",
        "4" => "00100",
        "5" => "00101",
        "6" => "00110",
        "7" => "00111",
        "8" => "01000",
        "9" => "01001",
        "a" => "01010",
        "b" => "01011",
        "c" => "01100",
        "d" => "01101",
        "e" => "01110",
        "f" => "01111",
        "g" => "10000",
        "h" => "10001",
        "i" => "10010",
        "j" => "10011",
        "k" => "10100",
        "l" => "10101",
        "m" => "10110",
        "n" => "10111",
        "o" => "11000",
        "p" => "11001",
        "q" => "11010",
        "r" => "11011",
        "s" => "11100",
        "t" => "11101",
        "u" => "11110",
        "v" => "11111",
    );

    /**
     * Returns binary string representation for string
     *
     * Example: \Koksosk\Base32Hex::stringToBinary("Hello") will return "0100100001100101011011000110110001101111"
     *
     * @param string $inputString
     *
     * @return string
     */
    public static function stringToBinary($inputString)
    {
        return implode('', array_map(function ($char) {
            return str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
        }, str_split($inputString)));
    }

    /**
     * Returns string representation from binary string
     *
     * Example: \Koksosk\Base32Hex::binaryToString("0100100001100101011011000110110001101111") will return "Hello"
     *
     * @param string $inputString
     *
     * @return string
     */
    public static function binaryToString($inputString)
    {
        return implode('', array_map(function ($char) {
            return chr(bindec($char));
        }, str_split($inputString, 8)));
    }

    /**
     * Encode string into base32hex string
     *
     * Example: \Koksosk\Base32Hex::encode("Hello") will return "91IMOR3F"
     *
     * @param string $inputString
     *
     * @return string
     */
    public static function encode($inputString)
    {
        $binStr = self::stringToBinary($inputString);

        // stuff string end with zero chars ('0') to be divisable by 5
        while (strlen($binStr) % self::$base32HexBits != 0) {
            $binStr .= "0";
        }

        $alpha = self::$base32HexAlphabet;
        return implode('', array_map(function ($str) use ($alpha) {
            return array_search($str, $alpha);
        }, str_split($binStr, self::$base32HexBits)));
    }

    /**
     * Decode base32hex string to string
     *
     * Example: \Koksosk\Base32Hex::decode("91IMOR3F") will return "Hello"
     *
     * @param string $inputString
     *
     * @return string
     */
    public static function decode($inputString)
    {
        $alpha = self::$base32HexAlphabet;
        $binStr = implode("", array_map(function ($key) use ($alpha) {
            return $alpha[$key];
        }, str_split($inputString)));

        // remove 'stuffed' zero chars ('0') from string end to be divisable by 8
        while (strlen($binStr) % 8 != 0) {
            $binStr = substr($binStr, 0, -1);
        }

        return implode('', array_map(function ($str) {
            return chr(bindec($str));
        }, str_split($binStr, 8)));
    }
}