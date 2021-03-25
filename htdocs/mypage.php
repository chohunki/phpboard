<?php
    include "db_config.php";
    header('Content-Type: text/html; charset=utf-8');
    session_start();

    //$conn = dbconn();
    //$query = "select id from member where id = '" . $_SESSION['session_id'] . "' ;";
    //$result = mysqli_query($conn, $query);
    //while ($row = mysqli_fetch_array($result))
    //{
        //$id
    //}
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
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light">
    <!-- 리스트 : 부트스트랩은 모바일 우선이라 화면이 작으면 아래로 쌓아서 내려온다 -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="home.php">게시글 목록</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">로그아웃</a>
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
                <td><input type="text" name="id" value="<?php echo $_SESSION['session_id']; ?>" class="form-control" readonly="readonly"></td>
            </tr>
            <tr>
                <td>비밀번호:</td>
                <td><input type="password" name="password" class="form-control"></td>
            </tr>
        </table>
        <button type="submit" name="user_modify" formaction="user_modify.php" formmethod="post" class="btn btn-sm btn-primary btn-block" style="width: 30%; display: inline;">수정하기</button>
        <button type="submit" name="user_delete" formaction="user_deleteform.php" formmethod="post" class="btn btn-sm btn-primary btn-block" style="width: 30%;  display: inline; margin-top: 0; ">탈퇴하기</button>
    </form>
</div>
</body>
</html>