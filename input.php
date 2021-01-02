<?php
session_start();

require 'validation.php';

$pageFlag = 0;
$errors   = validation($_POST);
$name     = '';
$email    = '';
$url      = '';
$gender   = '';
$age      = '';
$contact  = '';

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

// if (!empty($_POST)) {
//     echo '<pre>';
//     var_dump($_POST);
//     echo '</pre>';
// }

if (!empty($_POST['name'])) {
    $name = h($_POST['name']);
}
if (!empty($_POST['email'])) {
    $email = h($_POST['email']);
}
if (!empty($_POST['url'])) {
    $url = h($_POST['url']);
}
if (isset($_POST['gender'])) {
    $gender = h($_POST['gender']);
}
if (!empty($_POST['age'])) {
    $age = h($_POST['age']);
}
if (!empty($_POST['contact'])) {
    $contact = h($_POST['contact']);
}

if (!empty($_POST['btn_confirm']) && empty($errors)) {
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        .error {
            color: red;
        }
    </style>
    <title>form</title>
</head>

<body>

    <?php if ($pageFlag === 0) : ?>
        <?php
        if (!isset($_SESSION['csrfToken'])) {
            $csrfToken = bin2hex(random_bytes(32));
            $_SESSION['csrfToken'] = $csrfToken;
        }
        $token = $_SESSION['csrfToken'];
        ?>

        <?php if (!empty($errors) && !empty($_POST['btn_confirm'])) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li class="error"><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">氏名</label>
                            <input class="form-control" type="text" name="name" value="<?php echo $name; ?>" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input class="form-control" type="email" name="email" value="<?php echo $email; ?>" id="email">
                        </div>
                        <div class="form-group">
                            <label for="url">ホームページ</label>
                            <input class="form-control" type="url" name="url" value="<?php echo $url; ?>" id="url">
                        </div>
                        <div class="form-check form-check-inline">
                            <p>性別</p>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="0" id="man" <?php if (!empty($gender) && $gender === '0') {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                            <label class="form-check-label" for="man">男性</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="1" id="woman" <?php if (!empty($gender) && $gender === '1') {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                            <label class="form-check-label" for="woman">女性</label>
                        </div>
                        <div class="form-group">
                            <label for="age">年齢</label>
                            <select class="form-control" name="age" id="for">
                                <option value="">選択してください</option>
                                <option value="1" <?php if (!empty($age) && $age === '1') {
                                                        echo 'selected';
                                                    } ?>>~19歳</option>
                                <option value="2" <?php if (!empty($age) && $age === '2') {
                                                        echo 'selected';
                                                    } ?>>20歳~29歳</option>
                                <option value="3" <?php if (!empty($age) && $age === '3') {
                                                        echo 'selected';
                                                    } ?>>30歳~39歳</option>
                                <option value="4" <?php if (!empty($age) && $age === '4') {
                                                        echo 'selected';
                                                    } ?>>40歳~49歳</option>
                                <option value="5" <?php if (!empty($age) && $age === '5') {
                                                        echo 'selected';
                                                    } ?>>50歳~59歳</option>
                                <option value="6" <?php if (!empty($age) && $age === '6') {
                                                        echo 'selected';
                                                    } ?>>60歳~</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact" style="vertical-align: top;">お問い合わせ内容</label>
                            <textarea class="form-control" name="contact" id="contact" cols="30" rows="5"><?php echo $contact; ?></textarea>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="caution" value="1" id="caution">
                            <label class="form-check-label" for="caution">注意事項にチェックする</label>
                        </div>
                        <input class="btn btn-info" type="submit" name="btn_confirm" value="送信">
                        <input type="hidden" name="csrf" value="<?php echo $token; ?>">
                        <br>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($pageFlag === 1) : ?>
        <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
            <form action="" method="post">
                <p>氏名： <?php echo $name; ?></p>
                <p>メールアドレス： <?php echo $email; ?></p>
                <p>ホームページ： <?php echo $url; ?></p>
                <p>性別
                    <?php if ($gender === '0') {
                        echo '男性';
                    } elseif ($gender === '1') {
                        echo '女性';
                    }
                    ?>
                </p>
                <p>年齢
                    <?php if ($age === '1') {
                        echo '~19歳';
                    } elseif ($age === '2') {
                        echo '20歳~29歳';
                    } elseif ($age === '3') {
                        echo '30歳~39歳';
                    } elseif ($age === '4') {
                        echo '40歳~49歳';
                    } elseif ($age === '5') {
                        echo '50歳~59歳';
                    } elseif ($age === '6') {
                        echo '60歳~';
                    }     ?>
                </p>
                <p>お問い合わせ内容 <?php echo $contact; ?></p>
                <input type="submit" name="back" value="戻る">
                <input type="submit" name="btn_submit" value="送信">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="url" value="<?php echo $url; ?>">
                <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                <input type="hidden" name="age" value="<?php echo $age; ?>">
                <input type="hidden" name="contact" value="<?php echo $contact; ?>">
                <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($pageFlag === 2) : ?>
        <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
            <p>送信が完了しました。</p>
            <?php unset($_SESSION['csrfToken']); ?>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
