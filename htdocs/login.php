<?php
header('Content-Type: text/html; charset=utf-8');
?>

<?php
    include "db_config.php";

    $id = $_POST['id'];
    $password = $_POST['password'];
    $realpassword = '123';



    $conn = dbconn();
    $query = "select password from member where id = '" . $id . "';";
    $result = mysqli_query($conn, $query);



    while ($row = mysqli_fetch_array($result))
    {
        $realpassword  = $row['password'];
    }


    if($password == $realpassword)
    {
        session_start();
        $_SESSION['session_id'] = $id;
        if(isset($_SESSION['session_id']))
        {
            header('Location: home.php');
        }

    }
    else
    {
        //header('Location: index.php');
        echo "<script>
                alert(\"아이디나 비밀번호를 확인해주세요\");
                document.location.href=\"index.php\";
              </script>";
    }
    mysqli_close($conn);
?>