<?php
include 'Crud.php';
$object = new Crud();

    session_start();

?>
<html>
<head>
    <title>수정하기</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script>
    function validate() {
        var title = document.getElementById("title");
        var content = document.getElementById("content");

        if(title.value != ""){
            if(content.value != ""){
                return true;
            }
            else{
                alert("본문을 입력해주세요");
                content.focus();
                return false;
            }
        }
        else{
            alert("제목을 입력해주세요");
            title.focus();
            return false;
        }

    }



</script>

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
<div class="container" id="modify_div">

</div>
</body>

<script>
    $(document).ready(function(){
        load_modify();

        function load_modify() {


            var action = "load_modify";
            var idx = <?php echo $_GET['idx'];  ?>;

            $.ajax({
                url: "action.php",
                type: "GET",
                data: {action: action, idx:idx},
                success: function (data) {

                    $('#modify_div').html(data);
                }
            });


        }


    });

    function board_modify(){
        var title = $('#title').val();
        var writer = $('#writer').val();
        var content = $('#content').val();
        var idx = <?php echo $_GET['idx']?>;

        if(title != '' && writer !='' && content !='')
        {

            var action = "board_modify";
            //$.post("./action.php","{action: action, id:id, password:password}",function(data){alert(data);})

            $.ajax({
                url: "action.php",
                type: "post",
                data: {action: action, title:title, writer:writer, content:content,idx:idx},
                success: function (data) {
                    location.href = "home.php";
                }
            });

        }else
        {
            alert("빈칸이 있습니다");
        }
    }

    function logout(){
        alert("로그아웃 되었습니다.");
        location.href="index.php";
    }


</script>

</html>



