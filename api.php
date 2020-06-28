<?php
session_start();
if (!empty($_GET['id'])) {
    $conn = mysqli_connect('localhost', 'thuan', 'thuanvp012', 'nhan_tin');
    mysqli_set_charset($conn, 'utf8');
    $id = $_GET['id'];
    $time = date("Y-m-d H:i:s");
    $kq = mysqli_query($conn, "select * from sessions where id=$id");
    if (mysqli_num_rows($kq) == 0) {
        $ten = $_SESSION['ten'];
        mysqli_query($conn, "insert into sessions (id,ten,times) values ($id,'$ten','$time')");
    } else {
        mysqli_query($conn, "update sessions set times='$time' where id=$id");
    }
    $time_unix = time() - 3;
    $time = date("Y-m-d H:i:s", $time_unix);
    mysqli_query($conn, "delete from sessions where times < '$time'");

    $kq = mysqli_query($conn, "select id,ten from sessions where id!=$id");
    $arr = [];
    while ($row = mysqli_fetch_assoc($kq)) {
        $arr[] = $row;
    }
    print_r(json_encode($arr));
}
