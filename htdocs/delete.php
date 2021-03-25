<?php
include "db_config.php";
header('Content-Type: text/html; charset=utf-8');
session_start();

$conn = dbconn();

$query = "delete from board where idx = '" . $_GET['idx'] . "' ;";
mysqli_query($conn, $query);
mysqli_close($conn);

header('Location: home.php');
?>