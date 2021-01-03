<?php
session_start();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

if (!isset($_SESSION['visited'])) {
    echo '初回訪問です。' . PHP_EOL;

    $_SESSION['visited'] = 1;
    $_SESSION['date'] = date('c');
} else {

    $visited = $_SESSION['visited'];
    $visited++;
    $_SESSION['visited'] = $visited;

    echo $_SESSION['visited'] . '回目の訪問です。';

    if (isset($_SESSION['date'])) {
        echo '前回訪問は、' . $_SESSION['date'] . 'です。' . PHP_EOL;
        $_SESSION['date'] = date('c');
    }
}

?>
</body>
</html>
