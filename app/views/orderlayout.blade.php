
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧 - 下单</title>  
<link rel="stylesheet" type="text/css" href="/static/common.css">
<link rel="stylesheet" type="text/css" href="/static/order.css?id=7">
<script src="/static/jquery-1.7.2.min.js"></script>
<script src="/static/jquery.cookie.min.js"></script>
<script src="/static/json2.min.js"></script>

<script type="text/javascript">
g_min_money = 30;
g_delivery_fee = 5;

document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});

$().ready(function(){
    var ck = $.cookie('orderFoods');
    console.log("ck-->%o", ck);
    if(ck == undefined){
        return;
    }
    oFoods = JSON.parse(ck);
    if(oFoods != undefined) {
        var allmoney = 0;
        var arr_keys = ['加辣','加醋','加青菜','加豆芽','加豆皮','加肉类','加米线'];
        for(var key in oFoods){
            var of = oFoods[key];
            console.log(of);
            var xkey = key;
            var allplus = "";
            if(of.allplus){
                for (var i = 0; i < arr_keys.length; i++) {
                    if(arr_keys[i] in of.allplus){
                        allplus += '<b style=\"color:#333333\">o</b>' + of.allplus[arr_keys[i]].name + "&nbsp;";
                    }
                }
            }

            if(key.indexOf('-') > 0) {
                xkey = key.substring(0, key.indexOf('-'));
            }
            var ss = "<div id=\"row-"+key+"\" class=\"row\"><div class=\"foodname ";
            if(allplus != ""){
                ss += "noodles\">" + of.name; 
                ss += "<br><span class=\"pluss\">"+allplus+"</span>"
            }else{
                ss += "\">" + of.name;
            }
            ss += "</div><div class=\"foodprice\">"
                + of.price + "</div>"
                + "<div class=\"increment\" id=\"" + key + "-increment\" onclick=\"javascript:increment('"+key+"',"+of.price+")\">+</div>"
                + "<div id=\""+key+"\" class=\"count\">"+of.count+"</div>"
                + "<div class=\"reduce\" id=\""+key+"-reduce\" onclick=\"javascript:reduce('"+key+"',"+of.price+")\">—</div>"
                + "</div><div class=\"clear\"></div><hr id=\"hr-"+key+"\" >";
            $("#foodlist").append(ss);
            allmoney += of.price * of.count;
        }
        var prize = @yield('prize');
        var totalmoney = allmoney - prize;
        if(allmoney < g_min_money) {
            totalmoney += g_delivery_fee;
            $("#deliveryfee").text(g_delivery_fee+"元");
        }
        $("#allprice").text(allmoney+"元");
        $("#prize").text(prize + "元");
        $("#prizeH").val(prize);
        $("#allpriceH").val(totalmoney * 1);

        $("#submitbtn").val("应付总额：" + (totalmoney * 1).toFixed(2) + "元   提交订单");
    }
    // var  tester = @yield('tester');
    // if(tester == 1){
    //     $("#pay2").show();
    // }else{
    //     $("#pay2").hide();
    // }
});


function increment(id, price) {
    var i = parseInt($("#"+id).text());
    var x;
    if(isNaN(i)) {
        x = 1;
    }else {
        x = i + 1;
    }
    $("#"+id).text(x);
    $("#"+id).addClass("count");
    $("#"+id).removeClass("gray");
    var p = parseInt($("#allprice").text());
    var allmoney = p + price;
    var dfee = g_delivery_fee;
    if(allmoney >= g_min_money) {
        dfee = 0;
        $("#deliveryfee").text(dfee+"元");
    }
    $("#allprice").text(allmoney+"元");
    var prize = @yield('prize');
    var totalmoney = allmoney - prize + dfee;
    $("#allpriceH").val(totalmoney * 1);
    $("#submitbtn").val("应付总额：" + (totalmoney * 1).toFixed(2) + "元   提交订单");
    var ck = $.cookie('orderFoods');
    if(ck == undefined){
        return;
    }
    oFoods = JSON.parse(ck);
    if (id in oFoods) {
        oFoods[id].count += 1; 
    }
    $.cookie('orderFoods', JSON.stringify(oFoods),{path: '/'});
}
function reduce(id, price) {
    var i = parseInt($("#"+id).text());
    if(i == 0 || isNaN(i)) {
        return;
    }
    var x;
    if(i == 1) {
        x = "";
        $("#"+id).addClass("gray");
        $("#row-"+id).hide();
        $("#hr-"+id).hide();
    }else {
        x = i - 1;
    }
    $("#"+id).text(x);
    var p = parseInt($("#allprice").text());
    var allmoney = p - price;
    var dfee = 0;
    if(allmoney < g_min_money) {
        dfee = g_delivery_fee;
        $("#deliveryfee").text(dfee+"元");
    }
    $("#allprice").text(allmoney+"元");
    var prize = @yield('prize');
    var totalmoney = allmoney - prize + dfee;
    if(totalmoney < 0){
        totalmoney = 0;
    }
    $("#allpriceH").val(totalmoney);
    $("#submitbtn").val("应付总额：" + (totalmoney * 1).toFixed(2) + "元   提交订单");
    var ck = $.cookie('orderFoods');
    if(ck == undefined){
        return;
    }
    oFoods = JSON.parse(ck);
    if (id in oFoods) {
        oFoods[id].count -= 1; 
        if(oFoods[id].count == 0){
            oFoods[id] = undefined;
        }
    }
    $.cookie('orderFoods', JSON.stringify(oFoods), {path: '/'});
}

function clearCar(){
    var c = confirm("您确定要清空购物车吗？");
    if(!c) return false;
    $.cookie('orderFoods', '', {path: '/',expires: -1} );
    $.cookie('orderFoods', '', {path: '/order',expires: -1});
    $("#main").hide();
    $("#clearall").show();
}
function chooseDate(){
    var ddate = $("#ddate");
    var dtime = $("#dtime");
    var d = new Date();
    var year = d.getFullYear();
    var month = d.getMonth() + 1; // 记得当前月是要+1的
    var dt = d.getDate();
    var month = d.getMonth() + 1;
    month = month < 10 ? ("0" + month) : month;
    var dt = d.getDate();
    dt = dt < 10 ? ("0" + dt) : dt;
    var today = year + "-" + month + "-" + dt;
    var tomorrow = year + "-" + month + "-" + (dt + 1);
    var after = year + "-" + month + "-" + (dt + 2);
    var hours = d.getHours() + 1;
    if(hours < 10) hours = 10;
    var minutes = d.getMinutes();
    //console.log(today);
    $("#ddate").empty();
    if(hours < 21){
        jQuery("<option></option>").val(today).text(today+"(今天)").appendTo("#ddate")
    }
    jQuery("<option></option>").val(tomorrow).text(tomorrow+"(明天)").appendTo("#ddate")
    jQuery("<option></option>").val(after).text(after+"(后天)").appendTo("#ddate")
    minutes = 15 * (minutes % 15 + 1);
    minutes = minutes == 60 ? 0 : minutes;
    d.setMinutes(minutes);
    d.setHours(hours);
    var now = d.getTime();
    var i = 0;
    for(;;){
        d.setTime(now + 15 * 60 * 1000 * i++);
        var dtime = d.getHours() + ":" + (d.getMinutes() < 10 ? "0" + d.getMinutes() : d.getMinutes());
        jQuery("<option></option>").val(dtime).text(dtime).appendTo("#dtime")
        if(d.getHours() == 21) {
            break;
        }
    }
    $("#choosedate").show();   
}

function initDtime(){
    var d = new Date();
    var year = d.getFullYear();
    var month = d.getMonth() + 1; // 记得当前月是要+1的
    var dt = d.getDate();
    var month = d.getMonth() + 1;
    month = month < 10 ? ("0" + month) : month;
    var dt = d.getDate();
    dt = dt < 10 ? ("0" + dt) : dt;
    var today = year + "-" + month + "-" + dt;    
    var minutes = d.getMinutes();
    minutes = 15 * (minutes % 15 + 1);
    minutes = minutes == 60 ? 0 : minutes;
    d.setMinutes(minutes);
    if($("#ddate").val() !== today){
        d.setHours(10);
        d.setMinutes(0);
    }else{
        d.setHours(d.getHours() + 1);
    }
    var now = d.getTime();
    var i = 0;
    $("#dtime").empty();
    for(;;){
        d.setTime(now + 15 * 60 * 1000 * i++);
        var dtime = d.getHours() + ":" + (d.getMinutes() < 10 ? "0" + d.getMinutes() : d.getMinutes());
        jQuery("<option></option>").val(dtime).text(dtime).appendTo("#dtime")
        if(d.getHours() == 21) {
            break;
        }
    }    
}
function fapiaoCheck() {
    if($("#fapiao").attr('checked')){
        $("#fapiaotype").show();
    }else{
        $("#fapiaotype").hide();
    }
}

var g_addrs = {};
function chooseAddr(addrid){
    var htmlobj = $.ajax({url:"/order/chooseaddress",async:false});
    // alert(htmlobj.responseText);
    g_addrs = JSON.parse(htmlobj.responseText);
    $("#addrs").empty();
    for(var i in g_addrs){
        var addr = g_addrs[i];
        //alert("1:" + addr.id);
        var ss = "<div class='addrbox' id='addr-"+addr.id+"' onclick='selectOneAddr("+addr.id+")'>"
            +   "<div class='addrcontent'>"
            +       "<div>"+addr.user_name+"&nbsp;&nbsp;"+addr.tel+"</div>"
            +       "<div>"+addr.address+"</div>"
            +       "<input type='hidden' name='addressid' id='addressid' value='"+addr.id+"'/>"
            +   "</div>"
            +   "<div class='newaddr'>"
            +       "<div> > </div>"
            +   "</div>"
            +"</div>"
            +"<div class='editbar' style='display:none;'>"
            +"<div class='del' onclick='javascript:deleteAddr("+addr.id+")'>删除</div>"
            +"<div class='edit' onclick='javascript:addOrEditAddr("+addr.id+")'>编辑</div>"
            +"</div>";
        $("#addrs").append(ss);
    }
    // alert("#addr-"+addrid);
    $("#addr-"+addrid).addClass("selectedaddr");
    $("#main").hide();
    $("#chooseaddr").show();
}

function finishAddr(){
    $("#chooseaddr").hide();
    $("#main").show();
}

function finishEditAddr(){
    $("#addoreditaddr").hide();
    $("#chooseaddr").show();
}
function finishAddAddr(){
    $("#addoreditaddr").hide();
    $("#chooseaddr").hide();
    $("#main").show();
}

function selectOneAddr(aid){
    var addr = g_addrs[aid];
    finishAddr();
    var ss = "<div class='addrcontent' onclick='javascript:chooseAddr("+addr.id+")'>"
        +       "<div>"+addr.user_name+"&nbsp;&nbsp;"+addr.tel+"</div>"
        +       "<div>"+addr.address+"</div>"
        +       "<input type='hidden' name='addressid' id='addressid' value='"+addr.id+"'/>"
        +   "</div>"
        +   "<input type='hidden' name='addressid' id='addressid' value='"+addr.id+"'/>"
        +   "<div class='newaddr'>"
        +       "<div> > </div>"
        +   "</div>";
    $("#theaddr").empty();
    $("#theaddr").append(ss);
}

function editAddrs(){
    if($("#editaddrs").text() == "完成"){
        $("#editaddrs").text("编辑");
        $(".editbar").hide();
    }else{   
        $("#editaddrs").text("完成");
        $(".editbar").show();
    }
}

function deleteAddr(id){
    var htmlobj = $.ajax({url:"/order/deladdress?aid="+id,async:false});
    var result = htmlobj.responseText;
    if(result == 'SUCCESS'){
        chooseAddr();
    }
}

function addOrEditAddr(id,init){
    $("#main").hide();
    $("#chooseaddr").hide();
    $("#addoreditaddr").show();
    if(id != undefined && id in g_addrs){
        //edit
        $("#address").val(g_addrs[id].address);
        $("#username").val(g_addrs[id].user_name);
        $("#tel").val(g_addrs[id].tel);
        $("#addrid").val(g_addrs[id].id);
    }else{
        $("#address").val("");
        $("#username").val("");
        $("#tel").val("");
        $("#addrid").val("");
    }
    if(init){
        $("#goback_addr").attr('onclick', 'javascript:finishAddAddr()');
    }
}

function checkSubmitAddr() {
    // alert(document.getElementById('allprice').innerHTML);
    if($('#address').val() == '')
    {
        alert('请填写地址');
        $('#address').focus();
        return false;
    }
    if($('#username').val() == '')
    {
        alert('请填写名字');
        $('#username').focus();
        return false;
    }
    if($('#tel').val() == '')
    {
        alert('请填写手机号');
        $('#tel').focus();
        return false;
    }
    $('#submitbtnaddr').val('提交中...');
    $('#submitbtnaddr').attr('disabled','disabled');
    var data={
        'address':$("#address").val(),
        'username':$("#username").val(),
        'tel':$("#tel").val(),
        'aid':$("#addrid").val()
    };
    $.post('/order/createaddress', data, function(){
        $("#addoreditaddr").hide();
        chooseAddr();
    });
}

function checkSubmit() {
    // alert(document.getElementById('allprice').innerHTML);
    if(parseInt($('#allprice').text()) == 0) {
        alert('请点餐');
        window.location.href="/menu";
        return false;
    }
    if($("#fapiao").attr("checked") && $("input[name='fapiaotype']:checked").val() == '2'){
        if($("#fpc").val() == ""){
            alert("请填写发票公司名称");
            $("#fpc").focus();
            return false;
        }
    }
    if($("#addressid").val() == undefined){
        alert("请填写配送地址");
        return false;
    }
    $('#submitbtn').val("订单提交中...");
    $('#submitbtn').attr("disabled", "disabled");  
    var ck = $.cookie('orderFoods');
    if(ck == undefined){
        window.location.href="/menu";
        return false;
    }
    oFoods = JSON.parse(ck);
    if(oFoods != undefined) {
        var arr_keys = ['加辣','加醋','加青菜','加豆芽','加豆皮','加肉类','加米线'];
        for(var key in oFoods){
            var of = oFoods[key];
            var allplus = "";
            if(of.allplus){
                for (var i = 0; i < arr_keys.length; i++) {
                    if(arr_keys[i] in of.allplus){
                        allplus += '/' + of.allplus[arr_keys[i]].name + "&nbsp;";
                    }
                }
                if(allplus.indexOf('/') == 0){
                    allplus = allplus.substring(1);
                }
            }
            of['allplusstr'] = allplus;
        }
    }
    $('#orderFoods').val(JSON.stringify(oFoods))
    $.cookie('orderFoods', '', {path: '/',expires: -1} );
    $.cookie('orderFoods', '', {path: '/order',expires: -1});
    document.getElementById('form').submit();
}

</script>
    </head>
    <body>
        <div id="main">
		<div id="topbar">
			<div class="goback" onclick="javascript:history.go(-1);">返回</div>
            <div id="clearbtn"><button class="topbtn" value="clear" onclick="javascript:clearCar();">清&nbsp;&nbsp;空</button></div>
        </div>
        <div id="container">
            <form action="createorder" id="form" method="post">
                <input type="hidden" name="orderFoods" id="orderFoods" value=""/>
                <div id="noodle">
                    <div class="subtitle">已点菜单</div>
                    <div id="foodlist" class="foodlist">    
                    </div>
                </div>    
                
                <div class="clear"></div>   
                <div class="deliverytime">
                    <div class="subtitle">送餐时间</div>
                    <div class="dtime">
                        <input type="radio" name="dtimetype" checked="true" value="0" onclick="javascript:$('#choosedate').hide()">立即送餐
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="dtimetype" value="1" onclick="javascript:chooseDate();">自选时间
                        <br>

                    </div>
                    <div class="dtime" style="display:none" id="choosedate">
                        <select id="ddate" name="ddate" onchange="javascript:initDtime();">
                        </select>
                        <select id="dtime" name="dtime">
                        </select>
                    </div>
                </div>
                <div class="clear"></div>   
                <div class="address">
                @yield('address')
    			</div>

                <div class="subtitle">付款方式</div>
                <div class="dtime" style="text-align:left">
                    <input type="radio" name="paytype" id="pay1" checked="true" value="1">货到付款
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="paytype" id="pay2" value="2">微信支付
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="paytype" id="pay3" value="3">会员支付 
                </div>
                <div class="clear"></div>   
                <div class="fapiao">
                    <div class="dtime">
                       发票(根据餐厅实际提供发票，可累计开)
                       <input type="checkbox" name="fapiao" id="fapiao" onchange="javascript:fapiaoCheck();"/>
                    </div>
                    <div class="dtime" style="display:none" id="fapiaotype">
                       发票类型 &nbsp;&nbsp;&nbsp;&nbsp;
                       <input type="radio" name="fapiaotype" value="1" onclick="javascript:$('#fapiaocompany').hide();"/>个人
                       <input type="radio" name="fapiaotype" value="2" onclick="javascript:$('#fapiaocompany').show();"/>公司
                    </div>
                    <div class="dtime" style="display:none" id="fapiaocompany">
                       <textarea name="fapiaocompany" id="fpc" style="font-size:14px" rows="3" placeholder="填写公司名称"></textarea>
                    </div>
                </div>

                <div id="comment">
                    <textarea name="comment" id="cmmt" rows="3" placeholder="还要说点什么吗？" style="font-size:14px"></textarea>
                </div>
                
    			<div id="totalprice">
                    <div class="feerow"><span class="feetitle">商品金额</span><span class="feemark">&nbsp;&nbsp;</span><span class="feenum" id="allprice">0元</span></div>
                    <div class="feerow"><span class="feetitle">优&nbsp;&nbsp;&nbsp;&nbsp;惠</span><span class="feemark">-</span><span class="feenum" id="prize">0元</span></div>
                    <div class="feerow"><span class="feetitle">运&nbsp;&nbsp;&nbsp;&nbsp;费</span><span class="feemark">+</span><span id="deliveryfee" class="feenum">0元</span></div>
                    <input type="hidden" name="allprice" id="allpriceH" value="0">
                    <input type="hidden" name="prize" id="prizeH" value="0">
                </div>

                <div id="allpay">
                    @yield('submitBtn')
                </div>
            </form>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
        </div>
        <div id="chooseaddr" style="display:none">
            <div id="topbar">
            <div class="goback" onclick="javascrip:finishAddr()">返回</div>
            <div id="editbtn"><button class="topbtn" id="editaddrs" value="edit" onclick="javascript:editAddrs();">编辑</button></div>
            </div>
            <div id="container">
                <div id="addrs">
                </div>
            </div>
            <div class="bottombar">
                    <div><input id="newaddrbtn" type="button" onClick="javascript:addOrEditAddr();" value="添加新地址"/></div>
            </div>
        </div>
        <div id="addoreditaddr" style="display:none">
            <div id="topbar">
                <div id="goback_addr" class="goback" onclick="javascrip:finishEditAddr()">返回</div>
            </div>
            <div id="container">
            <form action="createaddress" class="newaddrbox" id="form" method="post">
                <div id="addrfields">
                <div>
                    <input name="province" value="北京" style="background-color:#999999" onkeydown="return false;" onpaste="return false;" id="province" />
                </div>
                <div>      
                    <input name="city" value="北京市" style="background-color:#999999" onkeydown="return false;" onpaste="return false;"  id="province" />
                </div>
                <div>
                    <input name="area" value="朝阳区望京" style="background-color:#999999" onkeydown="return false;" onpaste="return false;" id="area" />
                </div>
                <div>
                    <textarea name="address" id="address" placeholder="地址, 配送暂时只开放望京地区(必填)"></textarea>
                </div>
                <div>
                    <input name="username" placeholder="姓名（必填）" id="username" />
                </div>
                <div>
                    <input name="tel" placeholder="手机号（必填）" id="tel" />
                    <input name="addrid" id="addrid" type="hidden" />
                </div>    
                </div>            
                <div id="confirm">
                   <b> <input id="saveaddrbtn" type="button" onClick="javascript:checkSubmitAddr();" value="确认保存"/></b>
                </div>

            </form>
            </div>
        </div>
        <div id="clearall" style="display:none">
            <div id="topbar">
                <div id="goback_clear" class="goback"  onclick="javascript:location.href='/menu'">返回</div>
            </div> 
            <div id="container">
                <div>购物车已经空了哦，快去点餐吧！</div>
                <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
            </div>
        </div>
    </body>
</html>