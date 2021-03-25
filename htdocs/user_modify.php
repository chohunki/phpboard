<?php
    include "db_config.php";
    header('Content-Type: text/html; charset=utf-8');
    session_start();

    $id = $_POST['id'];
    $password = $_POST['password'];
    $conn = dbconn();

    $query = "update member set password = '" . $password . "' where id = '" . $id . "' ;";
    mysqli_query($conn, $query);
    session_destroy();
    mysqli_close($conn);
    echo "<script>
                alert(\"변경되었습니다. 다시 로그인해주세요\");
                document.location.href=\"index.php\";
          </script>";
?>