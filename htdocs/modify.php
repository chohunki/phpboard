<?php
include "db_config.php";
header('Content-Type: text/html; charset=utf-8');
session_start();

$idx = $_POST['idx'];
$title = $_POST['title'];
$writer = $_POST['writer'];
$content = $_POST['content'];

$conn = dbconn();
$query = "update board set title = '" . $title . "', content = '" . $content . "', writer =  '" . $writer . "', regDate = now()  where idx = '" . $idx . "' ;";
mysqli_query($conn, $query);
mysqli_close($conn);
header('Location: home.php');
?>