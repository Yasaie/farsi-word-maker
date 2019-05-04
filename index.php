<?php
/**
 * @author      Payam Yasaie <payam@yasaie.ir>
 * @copyright   2019/05/04
 * @package     farsi-word-maker
 */

//ini_set("display_error", 0);
//error_reporting(0);

require 'app/lib/functions.php';

$word = isset($_GET['word']) ? $_GET['word'] : '';

if ($word)  {

    $len = strlen($word) / 2;
    $len = (isset($_GET['len']) and $_GET['len'] < $len) ? (int)$_GET['len'] : $len;

    $words_file = file_get_contents(__DIR__ . "/app/db/$len-letters.json");

    $words = json_decode($words_file, true);
    $letters = preg_split('//u', $word, 0, 1);

    $results = explode(',', makeWords($letters, $len));
    $results = array_unique($results);
    $results = array_filter($results, function($d) use ($words) {
        return in_array($d, $words);
    });

    sort($results);
}

include "app/layout/index.php";