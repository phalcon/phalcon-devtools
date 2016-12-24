<?php

namespace Phalcon;

/**
 * Phalcon\Text
 *
 * Provides utilities to work with texts
 */
abstract class Text
{

    const RANDOM_ALNUM = 0;


    const RANDOM_ALPHA = 1;


    const RANDOM_HEXDEC = 2;


    const RANDOM_NUMERIC = 3;


    const RANDOM_NOZERO = 4;


    /**
     * Converts strings to camelize style
     *
     * <code>
     * echo Phalcon\Text::camelize("coco_bongo"); // CocoBongo
     * echo Phalcon\Text::camelize("co_co-bon_go", "-"); // Co_coBon_go
     * echo Phalcon\Text::camelize("co_co-bon_go", "_-"); // CoCoBonGo
     * </code>
     *
     * @param string $str
     * @param mixed $delimiter
     * @return string
     */
    public static function camelize($str, $delimiter = null) {}

    /**
     * Uncamelize strings which are camelized
     *
     * <code>
     * echo Phalcon\Text::uncamelize("CocoBongo"); // coco_bongo
     * echo Phalcon\Text::uncamelize("CocoBongo", "-"); // coco-bongo
     * </code>
     *
     * @param string $str
     * @param mixed $delimiter
     * @return string
     */
    public static function uncamelize($str, $delimiter = null) {}

    /**
     * Adds a number to a string or increment that number if it already is defined
     *
     * <code>
     * echo Phalcon\Text::increment("a"); // "a_1"
     * echo Phalcon\Text::increment("a_1"); // "a_2"
     * </code>
     *
     * @param string $str
     * @param string $separator
     * @return string
     */
    public static function increment($str, $separator = "_") {}

    /**
     * Generates a random string based on the given type. Type is one of the RANDOM_ constants
     *
     * <code>
     * // "aloiwkqz"
     * echo Phalcon\Text::random(
     *     Phalcon\Text::RANDOM_ALNUM
     * );
     * </code>
     *
     * @param int $type
     * @param long $length
     * @return string
     */
    public static function random($type = 0, $length = 8) {}

    /**
     * Check if a string starts with a given string
     *
     * <code>
     * echo Phalcon\Text::startsWith("Hello", "He"); // true
     * echo Phalcon\Text::startsWith("Hello", "he", false); // false
     * echo Phalcon\Text::startsWith("Hello", "he"); // true
     * </code>
     *
     * @param string $str
     * @param string $start
     * @param bool $ignoreCase
     * @return bool
     */
    public static function startsWith($str, $start, $ignoreCase = true) {}

    /**
     * Check if a string ends with a given string
     *
     * <code>
     * echo Phalcon\Text::endsWith("Hello", "llo"); // true
     * echo Phalcon\Text::endsWith("Hello", "LLO", false); // false
     * echo Phalcon\Text::endsWith("Hello", "LLO"); // true
     * </code>
     *
     * @param string $str
     * @param string $end
     * @param bool $ignoreCase
     * @return bool
     */
    public static function endsWith($str, $end, $ignoreCase = true) {}

    /**
     * Lowercases a string, this function makes use of the mbstring extension if available
     *
     * <code>
     * echo Phalcon\Text::lower("HELLO"); // hello
     * </code>
     *
     * @param string $str
     * @param string $encoding
     * @return string
     */
    public static function lower($str, $encoding = "UTF-8") {}

    /**
     * Uppercases a string, this function makes use of the mbstring extension if available
     *
     * <code>
     * echo Phalcon\Text::upper("hello"); // HELLO
     * </code>
     *
     * @param string $str
     * @param string $encoding
     * @return string
     */
    public static function upper($str, $encoding = "UTF-8") {}

    /**
     * Reduces multiple slashes in a string to single slashes
     *
     * <code>
     * echo Phalcon\Text::reduceSlashes("foo//bar/baz"); // foo/bar/baz
     * echo Phalcon\Text::reduceSlashes("http://foo.bar///baz/buz"); // http://foo.bar/baz/buz
     * </code>
     *
     * @param string $str
     * @return string
     */
    public static function reduceSlashes($str) {}

    /**
     * Concatenates strings using the separator only once without duplication in places concatenation
     *
     * <code>
     * $str = Phalcon\Text::concat(
     *     "/",
     *     "/tmp/",
     *     "/folder_1/",
     *     "/folder_2",
     *     "folder_3/"
     * );
     *
     * // /tmp/folder_1/folder_2/folder_3/
     * echo $str;
     * </code>
     *
     * @param string $separator
     * @param string $a
     * @param string $b
     * @param string $...N
     * @return string
     */
    public static function concat() {}

    /**
     * Generates random text in accordance with the template
     *
     * <code>
     * // Hi my name is a Bob
     * echo Phalcon\Text::dynamic("{Hi|Hello}, my name is a {Bob|Mark|Jon}!");
     *
     * // Hi my name is a Jon
     * echo Phalcon\Text::dynamic("{Hi|Hello}, my name is a {Bob|Mark|Jon}!");
     *
     * // Hello my name is a Bob
     * echo Phalcon\Text::dynamic("{Hi|Hello}, my name is a {Bob|Mark|Jon}!");
     *
     * // Hello my name is a Zyxep
     * echo Phalcon\Text::dynamic("[Hi/Hello], my name is a [Zyxep/Mark]!", "[", "]", "/");
     * </code>
     *
     * @param string $text
     * @param string $leftDelimiter
     * @param string $rightDelimiter
     * @param string $separator
     * @return string
     */
    public static function dynamic($text, $leftDelimiter = "{", $rightDelimiter = "}", $separator = "|") {}

    /**
     * Makes a phrase underscored instead of spaced
     *
     * <code>
     * echo Phalcon\Text::underscore("look behind"); // "look_behind"
     * echo Phalcon\Text::underscore("Awesome Phalcon"); // "Awesome_Phalcon"
     * </code>
     *
     * @param string $text
     * @return string
     */
    public static function underscore($text) {}

    /**
     * Makes an underscored or dashed phrase human-readable
     *
     * <code>
     * echo Phalcon\Text::humanize("start-a-horse"); // "start a horse"
     * echo Phalcon\Text::humanize("five_cats"); // "five cats"
     * </code>
     *
     * @param string $text
     * @return string
     */
    public static function humanize($text) {}

}
