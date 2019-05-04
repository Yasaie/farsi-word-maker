<?php
/**
 * @author      Payam Yasaie
 * @copyright   2019/05/04
 * @package     farsi-word-maker
 */

/**
 * @author      Payam Yasaie <payam@yasaie.ir>
 * @copyright   2019/05/04
 *
 * @param array $arr    array of letters
 * @param int $size     final size of word
 * @param array $perArr (optional)
 * @param int $pos      (optional)
 *
 * @return string
 */
function makeWords(array $arr, int $size, array $perArr = [], int $pos = 0) : string
{
    $arrLen = count($arr);
    $arrVals = array_count_values($arr);

    if ($size == $pos) {
        return implode("", $perArr);
    } else {
        for ($i = 0; $i < $arrLen; $i++) {
            $perArrVals = array_count_values($perArr);
            if ($arrVals[$arr[$i]] > $perArrVals[$arr[$i]]) {
                $perArr[$pos] = $arr[$i];
                $output[] = makeWords($arr, $size, $perArr, $pos + 1);
            }
        }
    }
    return implode(',', $output);
}