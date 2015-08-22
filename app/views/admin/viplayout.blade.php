<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<meta http-equiv="refresh" content="15">
<title>魅尔吧微信</title>  
<script src="../static/jquery-1.7.2.min.js"></script>
<script src="../static/jquery.cookie.js"></script>
<style type="text/css"><!--  
body{font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:14px;margin:0;padding:0;color:white;background-color:#333333}
#topContainer{width: 100%;background-color: darkred;}
#container{width:100%;margin: auto; padding: auto}
.topbar{width: 960px;margin: auto;padding:auto;}
.topbar div{float: left; color: white;font-size: 16px;background-color: darkred;text-align: center; height: 80px;line-height: 80px}
#content{width:960px;background-color: #333333; margin: auto;padding:auto;}
.leftbar{width:200px;font-size:16px;float: left;border-right:1px solid #999999;background-color: #333333; text-align: left;color:black;line-height: 60px;background-color: #999999}
.leftbar div{padding-left: 20px;border-bottom: 1px solid #333333;cursor: pointer;}
.leftbar a:link{color: black;text-decoration: none;}
.leftbar a:visited{color: black;text-decoration: none; font-weight: bold}
.foodlist{float:left;background-color:#e6e6e6;color:black;padding-top: 10px}
.foodlist .row{clear:both; height:30px; line-height:30px;cursor: pointer;}
.foodlist .row div {float: left;}
.foodlist .last{border:0}
.type{padding-left: 0px;width:200px;;text-align: center}
.id{padding-left: 0px; width: 140px;text-align: center}
.time {padding-left:0px;width:320px;text-align: center}
.op {padding-left:0px;width:160px;text-align: center}
hr{border-top:1px solid #a6a6a6; border-bottom:1px solid white; margin: 0; padding: 0}
.clear{clear:both;}
#n1,#n2,#n3,#n4{color:darkred;font-size: 18px}
.selected{background-color: #ffffff}
#vipno{height:35px; text-align: left; padding-left: 5px; font-size: 16px;color:gray; width: 120px; margin-right:10px; border-right: 1px solid black}
#search{padding-left: 10px;text-align: left;color: white}
p{line-height: 30px; padding-left: 20px}
--></style>
<script type="text/javascript">
$().ready(function(){
    var a = "@yield('type')";
    $("#" + a).addClass('selected');
    var count = "@yield('count')";
    if(count > 0){
        playSound();
    }
});
function playSound(){
    $('embed').remove();  
    $('body').append('<embed src="/static/567.wav" autostart="true" hidden="true" loop="true">'); 
}

function search(){
    location.href='/admin/vip?type=SEARCH' + '&keyword=' + $('#vipno').val();
}

function vipResetPwd(vipno, id, status){
    if(status == 0){
        var r = confirm("确定要处理该会员的支付密码重置申请吗？选择确定，系统将随机产生一个密码，替换会员原有密码！");
        if(!r){
            return;
        }
    }
    location.href='/admin/vipresetpwd?vipno=' + vipno + "&resetid=" + id;
}
</script>
    </head>
    <body>
        <div id="topContainer">
            <div class="topbar">
                <div class="type">会员内容分类</div>
                <div class="id">会员卡号</div>
                <div class="time">操作时间</div>
                <div class="op">操作内容</div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="container">
            <div id="content">
                <div class="leftbar">
                    @yield('leftbar')
                    <div class="clear"></div>
                </div>

                <div class="foodlist">
                    
                    @yield('vipList')
                    
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </body>
</html>