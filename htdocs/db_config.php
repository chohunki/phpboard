<?php
    function dbconn()
    {
        $host_name="127.0.0.1:3306";
        $db_user_id="root";
        $db_name="board";
        $db_pw="1234";
        $conn = mysqli_connect($host_name,$db_user_id,$db_pw, $db_name);//mysql연결

        if($conn->connect_errno){
            die('connect error : '.$conn->connect_error);
        }
        return $conn; //호출한 페이지 종료 후 호출한 페이지로 넘어감
    }
?>

