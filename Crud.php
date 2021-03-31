
<?php

class Crud
{
    public $connect;
    private $host = "localhost";
    private $username = 'root';
    private $password = '1234';
    private $database = 'board';

//객체가 생성될때 호출
    function __construct()
    {
        $this -> database_connect();
    }

// db 연결 함수
    public function database_connect()
    {
        $this->connect = mysqli_connect($this -> host, $this-> username,
            $this->password, $this->database);
    }


//쿼리 실행 함수
    public function execute_query($query)
    {
        return mysqli_query($this -> connect, $query);
    }

//조회수
public function viewCount($query)
{
          $this -> execute_query($query);
}

//페이징실험
public function getAllCnt($query)
{
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }
    $result = $this ->execute_query($query);
    $row_num = mysqli_num_rows($result);  //총 게시글의 수
    $list = 5; //한 페이지에 보여줄 개수
    $block_ct = 5; //블록당 보여줄 페이지 개수

    $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기( 현재 페이지 / 블록당 보여줄 페이지 개수)
    $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호 ( ([현재페이지 블록-1] * 블록 당 보여줄 페이지 개수) + 1)
    $block_end = $block_start + $block_ct - 1; //블록 마지막 번호 ( 블록시작번호 + 블록당 보여줄 페이지 개수 -1)

    $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
    if($block_end > $total_page)
    {
        $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
    }
    //$total_block = ceil($total_page/$block_ct); //블럭 총 개수
    $start_num = ($page-1) * $list; //시작번호 (page-1)에서 한 페이지에 보여줄 개수 를 곱한다.  이거는 db 쿼리문에서 할거

    $result = $this ->execute_query("select idx,title, content, writer, regDate, viewCnt from board order by idx desc limit $start_num, $list;");

    $output = '';
    
    echo "
        <table class='table table-bordered table-striped'>
<tr>
<th width='10%'>글번호</th>
<th width='35%'>제목</th>
<th width='25%'>작성자</th>
<th width='20%'>작성일</th>
<th width='20%'>조회수</th>
</tr>
    ";

    while($row = mysqli_fetch_object($result))
    {
        echo "
            <tr>
<td>$row->idx</td>
<td> <a href='view.php?idx=$row->idx'>  $row->title    </a></td>
<td>$row->writer</td>
<td>$row->regDate</td>
<td>$row->viewCnt</td>
</tr>
        ";
    }

    echo "</table>";
    
    echo "
        <nav aria-label='... ' >
    <ul class='pagination justify-content-center'>
        ";
        if($page <= 1)
        {
            echo "
            <li class='page-item disabled'>
                <a class='page-link' href='home.php?page=1' tabindex='-1' aria-disabled='true'>처음</a>
            </li>
            <li class='page-item disabled'>
                <a class='page-link' href='home.php?page=1'>이전</a>
            </li>
            ";

        }
        else
        {
            echo "
            <li class='page-item'>
                <a class='page-link' href='home.php?page=1' tabindex='-1' aria-disabled='true'>처음</a>
            </li>
            <li class='page-item'>
                <a class='page-link' href='home.php?page="; echo $page - 1; echo "'>이전</a>
            </li>
            ";

        }
        for($i=$block_start; $i<=$block_end; $i++)
        {//for문 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
            if($page == $i) //만약 page가 $i와 같다면 버튼 비활성화
            {
                echo "
                    <li class='page-item active' aria-current='page'>
                        <a class='page-link' href='#'>"; echo $i; echo"</a>
                    </li>
                ";

            }
            else
            {
                echo "
                <li class='page-item'>
                    <a class='page-link' href='home.php?page="; echo $i; echo "'>";  echo $i; echo "</a>
                </li>
                ";
            }
        }

        if($page >= $total_page)//만약 page가 페이지수보다 크거나 같다면
        {
            echo "
                 <li class='page-item disabled'>
                <a class='page-link' href='home.php?page="; echo $page + 1; echo "'>다음</a>
            </li>
            <li class='page-item disabled'>
                <a class='page-link' href='home.php?page=1' tabindex='-1' aria-disabled='true'>마지막</a>
            </li>
            ";

        }
        else
        {
            echo "
            <li class='page-item '>
                <a class='page-link' href='home.php?page="; echo $page + 1; echo "'>다음</a>
            </li>
            <li class='page-item '>
                <a class='page-link' href='home.php?page="; echo $total_page; echo "' tabindex='-1' aria-disabled='true'>마지막</a>
            </li><br>
            
            ";

        }


        echo "
    </ul>
</nav>
    ";
        



    return $output;


}


    //상세조회
    public function get_data_in_table_detail($query)
    {
        $output ='';
        $result = $this ->execute_query($query);
        while($row = mysqli_fetch_object($result))
        {

            $title = $row->title;
            $writer = $row->writer;
            $regDate = $row->regDate;
            $viewCnt = $row->viewCnt;
            $content = $row->content;

            
            $output .="  
            " ;
          
        }
        $idx = $_GET['idx'];

        $output .= '

            <div class="container" style="cursor: default;">
                <h2>게시글 조회</h2><br>

                <table class="table table-bordered">
                    <tr>
                        <td id="head">제목</td><td>'.$title.'</td>
                        <td id="head">작성자</td><td>'.$writer.'</td>
                    </tr>
                    <tr>
                        <td id="head">작성일자</td><td>'.$regDate.'</td>
                        <td id="head">조회수</td><td>'.$viewCnt.'</td>
                    </tr>
                    <tr>
                        <td id="head">본문</td><td colspan="3">'.  nl2br($content) .'</td>
                    </tr>
                </table>';

        session_start();

        if($_SESSION['session_id'] == $writer)
        {
            $output .= <<<HTML
            <button name = "board_delete" type="button" class="btn btn-xs btn-primary" id="board_delete"  onclick="board_delete();"  style="display: inline;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg>
            삭제하기</button>
        <button name = "modify" class="btn btn-xs btn-primary" onclick="location.href='modifyform.php?idx=$idx'"  style="display: inline; margin-top: 0; ">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
            </svg>
            수정하기</button>
HTML;
        }


        $output .="</div>";
        return $output;
    }



    public function login_process($query){
        $result = $this ->execute_query($query);
        while($row = mysqli_fetch_array($result))
        {
            $test = $row['password'];


        }
        return $test;

    }

    public function board_write($query)
    {
        $this ->execute_query($query);
    }

    public function board_modify($query)
    {
        $this ->execute_query($query);
    }

    public function board_delete($query)
    {
        $this ->execute_query($query);
    }

    public function load_modify($query)
    {
        $result = $this ->execute_query($query);
        while($row = mysqli_fetch_object($result))
        {
            $title = $row->title;
            $writer = $row->writer;
            $regDate = $row->regDate;
            $viewCnt = $row->viewCnt;
            $content = $row->content;
        }
        $output = "";
        session_start();
        $s_id = $_SESSION['session_id'];
        $output .= <<<HTML
             <h2>수정하기</h2>

    <form action="modify.php" method="post" onsubmit="return validate()">
        <table class="table">
            <tr>
                <td>제목</td><td><input type="text" name="title" id="title" value="$title"  class="form-control"></td>
            </tr>
            <tr>
                <td>작성자</td><td><input type="text" id="writer" name="writer" value="$s_id" class="form-control" readonly="readonly"></td>
            </tr>
            <tr>
                <td>본문</td><td><textarea name="content" id="content" cols="50" rows="10" style="overflow: hidden;" class="form-control">$content</textarea></td>
            </tr>
            </tbody>

        </table>                                                   
        <button type="button" id="board_modify1" name="board_modify1" class="btn btn-sm btn-primary btn-block" onclick="board_modify();">수정하기</button>
    </form>
HTML;
        return $output;

    }

    public function member_join($query)
    {
        $this ->execute_query($query);
    }

    public function member_modify($query)
    {
        $this ->execute_query($query);
    }

    public function member_delete($query)
    {
        $result = $this ->execute_query($query);
        while($row = mysqli_fetch_array($result))
        {
            $test = $row['password'];

        }
        return $test;
    }

    public function member_delete_last($query)
    {
        $result = $this ->execute_query($query);
    }





}



?>
