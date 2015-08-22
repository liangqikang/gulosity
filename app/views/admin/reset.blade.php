<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧后台管理 - 重置密码</title>  
<script src="../static/jquery-1.7.2.min.js"></script>
<script src="../static/json2.js"></script>

<style type="text/css"><!--  
body{font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:14px;padding: 10px;color:white;background-color:#333333}
#container{width:960px;margin:auto;padding: auto}
#login{width:250px;margin:200px auto;padding: auto}
.box{-webkit-border-radius:8px;border:1px solid #ccc;background-color: white;padding: 0;margin: 10px 0;}
.row input{border: 0; height:30px; line-height: 30px;margin: 0 10px; width: 90%}
.title{font-size: 18px;}
.loginbtn{float: right;}
hr{margin: 0}
#submit{background-color:darkred;border:0;width:60px;height:20px;color: white;-webkit-border-radius:3px;-webkit-appearance: none;}
--></style>
<script type="text/javascript">
function checkSubmit() {
    // alert(document.getElementById('allprice').innerHTML);
    if($('#password').val() == '')
    {
        alert('请填写旧密码');
        $('#password').focus();
        return false;
    }
    if($('#password1').val() == '')
    {
        alert('请填写新密码');
        $('#password1').focus();
        return false;
    }
    if($('#password2').val() == '')
    {
        alert('请再次填写新密码');
        $('#password2').focus();
        return false;
    }
    //$('#submitbtn').val('提交中');
    // $('#submitbtn').attr('disabled','disabled');
    var data={
        'password':$("#password").val(),
        'password1':$("#password1").val(),
        'password2':$("#password2").val()
    };
    $.post('changepwd', data, function(result){
        // var r = JSON.parse(result);
        console.log(result);
        if(result.status < 0) {
            alert(result.msg);
            return false;
        }
        alert(result.msg + ". 请重新登录。");
        location.href = "/admin/quit";
    });
}
</script>
    </head>
    <body>
        <div id="container">
            <div id="login">
            <form action="/admin/reset" method="post">
                <div class="title">重置密码</div>
                <div class="box">
                    <div class="row"><input name="password" id="password" type="password" placeholder="请输入原密码"/></div>
                    <hr>
                    <div class="row"><input name="password1" id="password1" type="password" placeholder="请输入新密码"/></div>
                    <hr>
                    <div class="row"><input name="password2" id="password2" type="password" placeholder="请再次输入新密码"/></div>
                </div>
                <div class="loginbtn"><input type="button" name="submit" id="submit" onclick="javascript:checkSubmit()" value="更&nbsp;&nbsp;改" /></div>
            </form>
            </div>
        </div>
    </body>
</html>