<?php
include 'Crud.php';
$object = new Crud();
$object_cnt = new Crud();

if(isset($_POST["action"]))
{
    //리스트 조회
    if($_POST["action"] == "Load")

    {   echo $object -> getAllCnt("SELECT idx FROM board;");
        //echo $object -> get_data_in_table("SELECT * FROM board ORDER BY idx DESC");
    }


    //삽입
    if($_POST["action"] == "Insert")
    {
        $first_name = mysqli_real_escape_string($object ->connect, $_POST["first_name"]);
        $last_name = mysqli_real_escape_string($object ->connect, $_POST["last_name"]);


        $image = $object -> upload_file($_FILES["user_image"]);

        $query = "
        INSERT INTO users2 (first_name, last_name, image) VALUES 
        ('".$first_name."','".$last_name."','".$image."')
        ";
        $object -> execute_query($query);

        echo '추가성공';
    }

    //수정
    if($_POST["action"] == "Single")
    {
        $output = '';
        $query = "SELECT * FROM users2 WHERE id = '".$_POST["user_id"]."'";
        $result = $object -> execute_query($query);



        while($row = $result->fetch_all())
        {
            $output["first_name"] = $row["first_name"];
            $output["last_name"] =  $row["last_name"];
            $output["user_image"] = $row["image"];
            $output["image"] =  '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
        }

        echo json_encode($output);

    }





    //로그인
    if($_POST["action"]== "Login_process")
    {

        $id = $_POST['id'];
        $result =  $object -> login_process("select password from member where id = '" . $id . "';");

        if($result == $_POST['password'])
        {
            session_start();
            $_SESSION['session_id'] = $id;
            $login_check["check"] = "1";
        }
        else
        {
            $login_check["check"] = "0";

        }
        echo json_encode($login_check);
    }

    //board_write
    if($_POST["action"]== "board_write")
    {
        $title = $_POST['title'];
        $writer = $_POST['writer'];
        $content = $_POST['content'];
        $object -> board_write("insert into  board(title, content, writer) values('" . $title . "' ,  '" .$content . "',  '" .$writer . "');");

        echo "작성완료";
    }


    //board_modify
    if($_POST["action"]== "board_modify")
    {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $object -> board_modify("update board set title = '" . $title . "', content = '" . $content . "',  regDate = now()  where idx = '" . $_POST['idx'] . "' ;");

        echo "수정완료";
    }

    //게시글 삭제
    if($_POST["action"]== "board_delete")
    {
        $idx = $_POST['idx'];
        $object -> board_delete("delete from board where idx = '" . $idx . "' ;");

        echo "수정완료";
    }

    //member_join
     if($_POST["action"]== "member_join")
     {
         $id = $_POST['id'];
         $password = $_POST['password'];

         $object -> member_join("insert into  member(id, password) values('" . $id . "' ,  '" .$password . "');");

         echo "작성완료";
     }

    if($_POST["action"]== "member_modify")
    {

        $id = $_POST['id'];
        $password = $_POST['password'];
        $object -> member_modify("update member set password = '" . $password . "' where id = '" . $id . "' ;");

        echo "수정완료";
    }

    //탈퇴
    if($_POST["action"]== "member_delete")
    {
        $id = $_POST['id'];
        $password = $_POST['password'];
        $result = $object -> member_delete("select password from member where id = '" . $id . "' and  password = '" . $password . "' ;");



        if($result == $_POST['password'])
        {
            $object -> member_delete_last("delete from member where id = '" . $id . "' ;");
            session_start();
            session_destroy();
            echo "1";
        }
        else
        {
            echo "0";

        }
    }



}
else
{
    //상세 조회
    if($_GET["action"] == "Load_detail" && $_GET['idx'] != null)
    {
        $idx = $_GET['idx'];
        echo $object ->  viewCount("UPDATE board set viewCnt = viewCnt + 1 where idx = '" . $idx . "' ;");
        echo $object -> get_data_in_table_detail("SELECT idx, title, content, writer, regDate, viewCnt FROM board where idx = '". $idx . "' ;");

    }

    //리스트 조회
    if($_GET["action"] == "Load")

    {   echo $object -> getAllCnt("SELECT idx FROM board;");
       //echo $object -> get_data_in_table("SELECT * FROM board ORDER BY idx DESC");
    }

    //수정 게시글 조회
    if($_GET["action"]== "load_modify")
    {
        $idx = $_GET['idx'];
        echo $object -> load_modify("SELECT idx, title, content, writer, regDate, viewCnt FROM board where idx = '". $idx . "' ;");


    }
}


?>


