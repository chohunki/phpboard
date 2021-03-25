<?php
    header('Content-Type: text/html; charset=utf-8');
?>
<?php
    include "db_config.php";
    $title = $_POST['title'];
    $writer = $_POST['writer'];
    $content = $_POST['content'];
    $conn = dbconn();

    $query = "insert into  board(title, content, writer) values('" . $title . "' ,  '" .$content . "',  '" .$writer . "');";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);

    header('Location: home.php');
?>