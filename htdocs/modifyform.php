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

    mysqli_close($conn);

?>
<html>
<head>
    <title>수정하기</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
            <a class="nav-link" href="logout.php">로그아웃</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="mypage.php">마이페이지</a>
        </li>
    </ul>
</nav>
<div class="container">
    <h2>수정하기</h2>

    <form action="modify.php" method="post" onsubmit="return validate()">
        <table class="table">
            <tr>
                <td>제목</td><td><input type="text" name="title" id="title" value="<?php echo $title; ?>" class="form-control"></td>
                <input type="hidden" name="idx" value="<?php echo $idx; ?>">
            </tr>
            <tr>
                <td>작성자</td><td><input type="text" name="writer" value="<?php echo $writer; ?>" class="form-control" readonly="readonly"></td>
            </tr>
            <tr>
                <td>본문</td><td><textarea name="content" id="content" cols="50" rows="10" style="overflow: hidden;" class="form-control"><?php echo $content; ?></textarea></td>
            </tr>
            </tbody>

        </table>
        <button type="submit" class="btn btn-sm btn-primary btn-block">수정하기</button>
    </form>
</div>
</body>
</html>



