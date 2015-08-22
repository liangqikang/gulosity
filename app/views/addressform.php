
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>魅尔吧微信-添加地址</title>  
<style type="text/css"><!--  
body{font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:14px;padding: 10px;color:white;background-color:darkred}
#container{width:100%;margin-bottom:40px; padding: 20px;}
#container div{margin-top:10px;}
#container input{height:30px;border:1px solid black;color:white;background-color:brown; width: 80%;}
#container textarea{height:30px;border:1px solid black;color:white;background-color:brown; width: 80%;}
#submitbtn{background-color:white;color:darkred;border:1px solid black;width:80%;height:30px;margin:10px 20px 10px 0;-webkit-border-radius:8px;}
--></style>
<script type="text/javascript">
 
</script>
    </head>
    <body>
        <div id="container">
            <form action="newaddress" method="post">
                <div>
                    <input name="province" value="北京" id="province" />
                </div>
                <div>      
                    <input name="city" value="北京市" id="province" />
                </div>
                <div>
                    <input name="area" value="朝阳区" id="area" />
                </div>
                <div>
                    <textarea name="area" id="area" >地址(必填)</textarea>
                </div>
                <div>
                    <input name="username" value="姓名（必填）" id="username" />
                </div>
                <div>
                    <input name="tel" value="手机号（必填）" id="tel" />
                </div>                
                <div id="confirm">
                    <button id="submitbtn" type="submit" value="submit"><b>确认保存</b></button>
                </div>
            </form>
        </div>
    </body>
</html>