<?php

ini_set("display_error", 0);
error_reporting(0);

function makeWords($arr, $size, $perArr = [], $pos = 0) 
{
    $arrLen = count($arr);
    $arrVals = array_count_values($arr);

    if ($size == $pos) {
        return implode("", $perArr);;
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

if (isset($_GET['word']) and !empty($_GET['word']))  {

    $word = $_GET['word'];
    $len = strlen($word) / 2;
    $len = (isset($_GET['len']) and $_GET['len'] < $len) ? (int)$_GET['len'] : $len;

    $words_file = file_get_contents(__DIR__ . "/db/$len-letters.json");

    $words = json_decode($words_file, true);
    $letters = preg_split('//u', $word, 0, 1);

    $results = explode(',', makeWords($letters, $len));
    $results = array_unique($results);
    $results = array_filter($results, function($d) use ($words) {
        return in_array($d, $words);
    });

    sort($results);
} ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ساخت کلمات</title>
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>
<body>
    <form>
        <input type="text" name="word" placeholder="حروف" value=<?= @$_GET['word'] ?>>
        <select name="len" id="len">
<?php for ($i = 3; $i <= 10; $i++) : ?>
            <option value="<?= $i ?>"<?= (isset($len) and $len == $i) ? " selected" : ""  ?>><?= $i ?> حرفی</option>
<?php endfor; ?>
        </select>
    </form>
<?php if ($results) : ?>
    <h2 id="count"><?= count($results) ?> کلمه پیدا شد</h2>
    <ul>
<?php foreach ($results as $result) : ?>
        <li><?= $result ?></li>
<?php endforeach; ?>
    </ul>
<?php endif; ?>
<script type="text/javascript" src="assets/js/javascript.js"></script>
</body>
</html>

