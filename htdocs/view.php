<?php
    include "db_config.php";
    header('Content-Type: text/html; charset=utf-8');
    session_start();

    $conn = dbconn();
    $query = "SELECT idx, title, content, writer, regDate, viewCnt FROM board where idx = '" . $_GET['idx'] . "' ;";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result))
    {
        $idx  = $row['idx'];
        $title  = $row['title'];
        $content  = $row['content'];
        $writer  = $row['writer'];
        $regDate  = $row['regDate'];
        $viewCnt = $row['viewCnt'];
    }

    $query = "UPDATE board set viewCnt = viewCnt + 1 where idx = '" . $_GET['idx'] . "' ;";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);

?>
<html>
<head>
    <title>게시글 보기</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<style>
    .container{
        border: 1px solid;
        border-color: darkgray;
        border-radius: 6px;
        margin-top: 70px;
        padding-top: 20px;
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 20px;
    }
    .article_header{
        margin-top: 20px;
    }
    #head{
        background-color: #EAEAEA;
    }

</style>

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
<div class="container">
    <h2>게시글 조회</h2><br>

    <table class="table table-bordered">
        <tr>
            <td id="head">제목</td><td><?php echo $title; ?></td>
        </tr>
        <tr>
            <td id="head">작성자</td><td><?php echo $writer; ?></td>
        </tr>
        <tr>
            <td id="head">작성일자</td><td><?php echo $regDate; ?></td>
        </tr>
        <tr>
            <td id="head">본문</td><td><?php echo nl2br($content)    ; ?></td>
        </tr>


    </table>
    <?php
    if($_SESSION['session_id'] == $writer)
    {
        ?>
        <button name = "delete" class="btn btn-xs btn-primary" onclick="location.href='delete.php?idx=<?php echo $idx; ?>'"  style="display: inline;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg>
            삭제하기</button>
        <button name = "modify" class="btn btn-xs btn-primary" onclick="location.href='modifyform.php?idx=<?php echo $idx; ?>'"  style="display: inline; margin-top: 0; ">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>
            수정하기</button>
        <?php
    }
    ?>



</div>
</body>
</html>




