<?php
$pageFlag = 0;
$name     = '';
$email    = '';

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

if (!empty($_POST['name'])) {
    $name = h($_POST['name']);
}
if (!empty($_POST['email'])) {
    $email = h($_POST['email']);
}

if (!empty($_POST['btn_confirm'])) {
    $pageFlag = 1;
}

if (!empty($_POST['btn_submit'])) {
    $pageFlag = 2;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
</head>
<body>

<?php if ($pageFlag === 0) : ?>
    <form action="" method="post">
        <label for="name">氏名</label>
        <input type="text" name="name" value="<?php echo $name; ?>" id="">
        <br>
        <label for="email">メールアドレス</label>
        <input type="email" name="email" value="<?php echo $email; ?>" id="">
        <br>
        <input type="submit" name="btn_confirm" value="送信">
        <br>
    </form>
<?php endif; ?>

<?php if ($pageFlag === 1) : ?>
    <form action="" method="post">
        <p>氏名： <?php echo $name; ?></p>
        <p>メールアドレス： <?php echo $email; ?></p>
        <input type="submit" name="back" value="戻る">
        <input type="submit" name="btn_submit" value="送信">
        <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
        <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
    </form>
<?php endif; ?>

<?php if ($pageFlag === 2) : ?>
    <p>送信が完了しました。</p>
<?php endif; ?>


</body>
</html>
