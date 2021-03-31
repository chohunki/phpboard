<?php


include 'Crud.php';
$object = new Crud();
$page = 1;
session_start();

?>

<html>
<head>
    <title>PHP 객체지향 방식으로 Mysql Ajax Crud </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .box {
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light">
    <!-- 리스트 : 부트스트랩은 모바일 우선이라 화면이 작으면 아래로 쌓아서 내려온다 -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="home.php">게시글 목록</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php" onclick="logout();">로그아웃</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="mypage.php">마이페이지</a>
        </li>
    </ul>
</nav>
<div class="container box">
    <h3 align="center">PHP<?php echo $_SESSION['session_id'];?></h3><br/>
    <br/>



    <!-- 유저 정보 데이터 뿌려주는 곳 -->
    <div id="user_table2" class="table-responsive">
    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function () {

        load_data();
        $('#action').val("Insert");


        function load_data() {
            var action = "Load_detail";
            var idx = <?php echo $_GET['idx'];  ?>;
            $.ajax({
                url: "action.php",
                type: "GET",
                data: {action: action, idx:idx},
                success: function (data) {
                    $('#user_table2').html(data);
                }
            });


        }




    });


    function board_delete(){
        var action = "board_delete";
        var idx = <?php echo $_GET['idx'];  ?>;
        //$.post("./action.php","{action: action, id:id, password:password}",function(data){alert(data);})

        $.ajax({
            url: "action.php",
            type: "POST",
            data: {action: action, idx:idx},
            success: function (data) {
                location.href = "home.php";
            }
        });
    }


    function logout(){

        alert("로그아웃 되었습니다.");
        location.href="index.php";
    }



</script>
