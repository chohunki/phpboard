<?php
    header('Content-Type: text/html; charset=utf-8');
?>
<?php
    include "db_config.php";
    $id = $_POST['id'];
    $password = $_POST['password'];
    $conn = dbconn();

    $query = "insert into  member(id, password) values('" . $id . "' ,  '" .$password . "' );";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<body>
<div class="col">
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 fw-normal">회원가입 완료</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">아이디: <b><?php echo $id; ?><b></b> <small class="text-muted"></small></h1>
            <h1 class="card-title pricing-card-title">비밀번호: <b><?php echo $password; ?><b></b> <small class="text-muted"></small></h1>
            <button type="button" class="w-100 btn btn-lg btn-primary" onclick="location.href='index.php'">로그인하러가기</button>
        </div>

</body>
</html>