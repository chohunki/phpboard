<?php
    include "db_config.php";
    header('Content-Type: text/html; charset=utf-8');
    session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>마이페이지</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light">
    <!-- 리스트 : 부트스트랩은 모바일 우선이라 화면이 작으면 아래로 쌓아서 내려온다 -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="home.php">게시글 목록</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php" onclick="logout();">로그아웃</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="mypage.php">마이페이지</a>
        </li>
    </ul>
</nav>
<div class="container" align="center">
    <form class="form">
        <h2>마이페이지</h2>
        <table class="table table" style="width: 80%">
            <tr>
                <td>아이디:</td>
                <td><input type="text" id="id" name="id" value="<?php echo $_SESSION['session_id']; ?>" class="form-control" readonly="readonly"></td>
            </tr>
            <tr>
                <td>비밀번호:</td>
                <td><input type="password" id="password" name="password" class="form-control"></td>
            </tr>
        </table>
        <button type="button" name="user_modify" formaction="user_modify.php" formmethod="post" class="btn btn-sm btn-primary btn-block" style="width: 30%; display: inline;" onclick="member_modify();">수정하기</button>
        <button type="button" name="user_delete" formaction="user_deleteform.php" formmethod="post" class="btn btn-sm btn-primary btn-block" style="width: 30%;  display: inline; margin-top: 0; " onclick="member_delete();">탈퇴하기</button>
    </form>
</div>
</body>
<script>





    function member_modify(){
        var id = $('#id').val();
        var password = $('#password').val();
        alert(password);

        if(id != '' && password !='')
        {

            var action = "member_modify";
            //$.post("./action.php","{action: action, id:id, password:password}",function(data){alert(data);})

            $.ajax({
                url: "action.php",
                type: "POST",
                data: {action:action,id: id, password:password},
                success: function (data) {
                    alert("수정되었습니다")
                    location.href = "mypage.php";
                }
            });

        }else
        {
            alert("빈칸이 있습니다");
        }
    }

    function member_delete(){
        var action = "member_delete";

        var id = $('#id').val();
        var password = $('#password').val();
        //$.post("./action.php","{action: action, id:id, password:password}",function(data){alert(data);})

        $.ajax({
            url: "action.php",
            type: "POST",
            data: {action,action,id: id, password:password},
            success: function (data) {
                if(data == 1)
                {
                    alert("탈퇴완료 되었습니다.");
                    location.href = "index.php";
                }
                else
                {
                    alert("비밀번호가 다릅니다.");
                    location.href = "mypage.php";
                }


            }
        });
    }

    function logout(){

        alert("로그아웃 되었습니다.");
        location.href="index.php";
    }

</script>
</html>