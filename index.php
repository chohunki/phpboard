<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<body>
<div class="container">

    <form class="form-signin" method="post" id="login_form">
        <h2 class="form-signin-heading">로그인<?php echo $_SERVER['REQUEST_METHOD']; ?></h2>
        <label for="inputEmail" class="sr-only">이메일</label>
        <input type="email" id="id" name="id" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">비밀번호</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <div class="checkbox">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="button" id="login" style="display: inline; width: 20%;">로그인</button>
        <button name = "write" class="btn btn-lg btn-primary btn-block" onclick="location.href='joinform.php'" style="display: inline; width: 20%; margin-top: 0;">회원가입하기</button>
    </form>

</div> <!-- /container -->

<script>

$(document).ready(function(){
    $('#login').click(function(event){

        var id = $('#id').val();
        var password = $('#password').val();
        var action = "Login_process";
        //var url = <?php echo $_SERVER['PHP_SELF']; ?>

        // var obj_login = new Object();
        // obj_login.id = id;
        // obj_login.password = password;
        // obj_login.action = "Login_process";
        //
        // var json_login = JSON.stringify(obj_login);


        if(id != '' && password !='')
        {
            //$.post("./action.php","{action: action, id:id, password:password}",function(data){alert(data);})

            $.ajax({
                url: "action.php",
                type: "post",
                dataType: "json",
                data: {action: action, id:id, password:password},
                success: function (data) {
                    var ww = JSON.stringify(data);
                    alert(ww);
                    if(data.check == 1){

                        location.href = "home.php";
                    }
                    else{
                        location.href = "index.php";
                    }

                }
            });


        }else
        {
            alert("빈칸이 있습니다");
        }
    });
});
</script>

</body>
</html>