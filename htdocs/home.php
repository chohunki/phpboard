<?php
    include "db_config.php";
    session_start();
    header('Content-Type: text/html; charset=utf-8');

    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }

    $conn = dbconn();
    $query = "SELECT idx FROM BOARD;";
    $result = mysqli_query($conn, $query);
    $row_num = mysqli_num_rows($result);  //총 게시글의 수

    $list = 5; //한 페이지에 보여줄 개수
    $block_ct = 5; //블록당 보여줄 페이지 개수

    $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
    $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
    $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

    $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
    if($block_end > $total_page)
    {
        $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
    }
    $total_block = ceil($total_page/$block_ct); //블럭 총 개수
    $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.


?>


<html>
<head>
    <title>게시판</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<script>
    function goBoardDetail(idx){
        location.href = "view.php?idx="+ idx;
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



<div class="container" align="center">
    <h1 a>게시글 목록</h1>
    <div class="container" align="left" style="margin-bottom: 10px;">
        <button name = "write" class="btn btn-xs btn-primary " onclick="location.href='writeform.php'" >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>
            글작성하기
        </button>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>글번호</th>
            <th>제목</th>
            <th>글쓴이</th>
            <th>작성일</th>
            <th>조회수</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $conn = dbconn();
            $s_point = ($page-1) * $list; //limit구문을 사용하기 위한 변수

            $query = "select idx,title, content, writer, regDate, viewCnt from board order by idx desc limit $start_num, $list;";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result))
            {
                $idx = $row['idx'];
                $title = $row['title'];
                $writer = $row['writer'];
                $regDate = $row['regDate'];
                $viewCnt = $row['viewCnt'];
                ?>
                <tr style="cursor: default;">
                    <td><?php echo $idx ?></td>
                    <td><a href="view.php?idx=<?php echo $idx; ?>"><?php echo $title ?></a></td>
                    <td><?php echo $writer ?></td>
                    <td><?php echo $regDate ?></td>
                    <td><?php echo $viewCnt ?></td>
                </tr>
                <?php
            }
        mysqli_close($conn);
        ?>



        </tbody>
    </table>
</div>

<!---페이징 넘버 --->
<nav aria-label="... " >
    <ul class="pagination justify-content-center">
        <?php
            if($page <= 1)
            {
                ?>
                <li class="page-item disabled">
                    <a class="page-link" href="home.php?page=1" tabindex="-1" aria-disabled="true">처음</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="home.php?page=1">이전</a>
                </li>
                <?php
            }
            else
            {
                ?>
                <li class="page-item">
                    <a class="page-link" href="home.php?page=1" tabindex="-1" aria-disabled="true">처음</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="home.php?page=<?php echo $page - 1; ?>">이전</a>
                </li>
                <?php
            }

            for($i=$block_start; $i<=$block_end; $i++)
            {//for문 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
                if($page == $i) //만약 page가 $i와 같다면 버튼 비활성화
                {
                    ?>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#"><?php echo $i; ?></a>
                    </li>
                    <?php
                }
                else
                {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="home.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php
                }
            }

            if($page >= $total_page)//만약 page가 페이지수보다 크거나 같다면
            {
                ?>
                <li class="page-item disabled">
                    <a class="page-link" href="home.php?page=<?php echo $page + 1; ?>">다음</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="home.php?page=1" tabindex="-1" aria-disabled="true">마지막</a>
                </li>
                <?php
            }
            else
            {
                ?>

                <li class="page-item ">
                    <a class="page-link" href="home.php?page=<?php echo $page + 1; ?>">다음</a>
                </li>
                <li class="page-item ">
                    <a class="page-link" href="home.php?page=<?php echo $total_page; ?>" tabindex="-1" aria-disabled="true">마지막</a>
                </li><br>
                <?php
            }

        ?>

    </ul>
</nav>



</body>
</html>

