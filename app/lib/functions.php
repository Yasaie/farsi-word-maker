<?php
/**
 * @author      Payam Yasaie <payam@yasaie.ir>
 * @copyright   2019/05/04
 * @package     farsi-word-maker
 */

/**
 * @author      Payam Yasaie <payam@yasaie.ir>
 * @copyright   2019/05/04
 *
 * @param $arr
 * @param $size
 * @param array $perArr
 * @param int $pos
 *
 * @return string
 */
function makeWords($arr, $size, $perArr = [], $pos = 0)
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