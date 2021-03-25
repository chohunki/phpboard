<?php
include "db_config.php";
header('Content-Type: text/html; charset=utf-8');
session_start();

$id = $_POST['id'];
$password = $_POST['password'];
$conn = dbconn();

$query = "select password from member where id = '" . $id . "' and  password = '" . $password . "' ;";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result))
{
    $getpw = $row['password'];
}

mysqli_close($conn);
if($getpw != null)
{
    $query = "delete from member where id = '" . $id . "' ;";
    mysqli_query($conn, $query);
    session_destroy();
    mysqli_close($conn);
    echo "<script>
                alert(\"탈퇴 완료되었습니다.\\n 이용해주셔서 감사합니다\");
                document.location.href=\"index.php\";
          </script>";
}
else
{
    echo "<script>
                alert(\"비밀번호를 확인해주세요\");
                document.location.href=\"mypage.php\";
          </script>";
}
?>