<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧后台管理 - 登录</title>  
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

    </head>
    <body>
        <div id="container">
            <div id="login">
            <form action="/admin/login" method="post">
                <div class="title">登录</div>
                <div class="box">
                    <div class="row"><input name="name" id="name" placeholder="用户名"/></div>
                    <hr>
                    <div class="row"><input name="password" id="name" type="password" placeholder="密码"/></div>
                </div>
                <div class="loginbtn"><input type="submit" name="submit" id="submit" value="登&nbsp;&nbsp;录" /></div>
            </form>
            </div>
        </div>
    </body>
</html>