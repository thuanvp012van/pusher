<?php
session_start();
if (!empty($_POST['ten'])) {
    $conn = mysqli_connect('localhost', 'thuan', 'thuanvp012', 'nhan_tin');
    mysqli_set_charset($conn, 'utf8');
    $ten = $_POST['ten'];
    $time = date("Y-m-d H:i:s");
    mysqli_query($conn, "insert into sessions (ten,times) values ('$ten','$time')");
    $kq = mysqli_query($conn, "select id from sessions where ten='$ten' and times='$time'");
    $row = mysqli_fetch_array($kq);
    $_SESSION['ten'] = $ten;
    $_SESSION['id'] = $row['id'];
    header("location:index.php");
} else
    $_SESSION['err'] = "lỗi rồi bạn ơi";
header("location:index.php");
