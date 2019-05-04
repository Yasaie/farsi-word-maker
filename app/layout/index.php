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
    <input type="text" name="word" placeholder="حروف" value=<?= $word ?>>
    <select name="len" id="len">
        <?php for ($i = 3; $i <= 10; $i++) : ?>
            <option value="<?= $i ?>"<?= (isset($len) and $len == $i) ? " selected" : ""  ?>><?= $i ?> حرفی</option>
        <?php endfor; ?>
    </select>
</form>
<?php if (isset($results)) : ?>
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