
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧 — 选择收货地址</title>  
<link rel="stylesheet" type="text/css" href="static/common.css">
<style type="text/css"><!--  
#topbar{margin: 0 auto; width: 100%; color: white; height: 50px;line-height:50px; clear: both;background-color: #410000; position:fixed; top:0; left:0;right: 0}
#topbar div{float:left}
#goback{width:68%; margin: 0 20px;}
#edit{background-color:darkred;border:0;width:60px;height:30px;color: white;-webkit-border-radius:3px;-webkit-appearance: none;}
.addrbox{clear:both;border:1px solid black;color:black;-webkit-border-radius:8px;background-color:#e6e6e6;padding: 5px; height: 60px; margin-bottom: 10px}
.addrcontent{float:left;width: 80%; line-height: 30px}
.newaddr{float:left; line-height: 50px}
.addrbox a:link{color: black;text-decoration: none;}
.addrbox a:visited{color: black;text-decoration: none; font-weight: bold}
.editbar{width:100%; height: 20px; line-height: 20px;margin-bottom: 10px}
.editbar .del{float:left;}
.editbar .edit{float:right;}
--></style>
<script type="text/javascript">

</script>
    </head>
    <body>
        <div id="topbar">
            <div id="goback" onclick="javascript:history.go(-1);">返回</div>
            <div id="editbtn"><button id="edit" value="edit" onclick="javascript:edit();">编&nbsp;&nbsp;辑</button></div>
        </div>
        <div id="container">
            <div id="addrs">
                @yield("addrs")
            </div>
        </div>

        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="images/mellbar_logo.png" width="120px"></div>
    </body>
</html>