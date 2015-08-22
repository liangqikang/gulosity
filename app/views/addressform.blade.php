
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>魅尔吧微信-添加地址</title>  
<link rel="stylesheet" type="text/css" href="static/common.css">
<style type="text/css"><!--  

#container div{margin-top:10px;}
#container input{height:30px;border:1px solid black;color:black;background-color:white; width: 80%;padding-left: 8px}
#container textarea{height:60px;border:1px solid black;color:black;background-color:white; width: 80%;padding-left: 8px}
#submitbtn{background-color:white;color:darkred;border:1px solid black;width:100%;height:30px;margin:10px auto;-webkit-border-radius:8px;-webkit-appearance: none;}
--></style>
<script type="text/javascript">
 function checkSubmit() {
    // alert(document.getElementById('allprice').innerHTML);
    if(document.getElementById('address').value == '')
    {
        alert('请填写地址');
        document.getElementById('address').focus();
        return false;
    }
    if(document.getElementById('username').value == '')
    {
        alert('请填写名字');
        document.getElementById('username').focus();
        return false;
    }
    if(document.getElementById('tel').value == '')
    {
        alert('请填写手机号');
        document.getElementById('tel').focus();
        return false;
    }
    document.getElementById('submitbtn').value = '提交中...';
    document.getElementById('submitbtn').disabled = 'disabled';
    document.getElementById('form').submit();
}
</script>
    </head>
    <body>
        <div id="container">
            <form action="createaddress" id="form" method="post">
                <div>
                    <input name="province" value="北京" disabled="disabled" id="province" />
                </div>
                <div>      
                    <input name="city" value="北京市" disabled="disabled"  id="province" />
                </div>
                <div>
                    <input name="area" value="朝阳区" disabled="disabled" id="area" />
                </div>
                <div>
                    <textarea name="address" id="address" placeholder="地址, 配送暂时只开放望京地区(必填)"></textarea>
                </div>
                <div>
                    <input name="username" placeholder="姓名（必填）" id="username" />
                </div>
                <div>
                    <input name="tel" placeholder="手机号（必填）" id="tel" />
                </div>                
                <div id="confirm">
                   <b> <input id="submitbtn" type="button" onClick="javascript:checkSubmit();" value="确认保存"/></b>
                </div>

            </form>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="images/mellbar_logo.png" width="120px"></div>
    </body>
</html>