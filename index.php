<?php
session_start();
if (!isset($_SESSION['id'])) {
    require './register.php';
} else {
    require './room.php';
}
