<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_SESSION['err'])) {
    ?>
        <h2><?php echo $_SESSION['err']; ?></h2>
    <?php
    }
    unset($_SESSION['err']);
    ?>
    <h3>nhập tên của bạn</h3>
    <form action="./process_register.php" method="post">
        <input type="text" name="ten" required><br>
        <button>register</button>
    </form>
</body>

</html>