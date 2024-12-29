<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    if (isset($error)) {
        echo $error;
    } 
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>
<body>
    <form action="<?= path . 'authservice/postlogin'?>" method="post">
        <input type="text" name="username">
        <input type="password" name="password">
        <input type="submit" name="btn">
    </form>
</body>
</html>