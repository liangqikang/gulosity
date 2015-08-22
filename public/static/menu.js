document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});
$(function() {
    $("img").lazyload({
        effect : "fadeIn"
    });
});
var orderFoods = {};
function selectFood(id, price, foodname, type) {
    var i = parseInt($("#"+id).text());
    var x;
    if(isNaN(i)) {
        x = 1;
    }else {
        x = i + 1;
    }
    $("#"+id).text(x);
    $("#"+id).addClass("red");
    $("#"+id+"-reduce").show();
    // $("#food-" + id).value = x;
    var c = parseInt($("#allcount").text());
    var p = parseInt($("#allprice").text());
    $("#allcount").text(c + 1);
    $("#allprice").text(p + price);
    var orderFood, key = id;
    if(type == 2) {
        key = id + "-" + x;
    }
    if(orderFoods[key] == undefined) {
        orderFood = {};
        orderFood['id'] = id;
        orderFood['name'] = foodname;
        orderFood['oprice'] = price;
        orderFood['price'] = price;
        orderFood['type'] = type;
        orderFood['count'] = 1;
        orderFood['allplus'] = {};
        if(type == 2){
            var plus = {'name':"微辣", 'id':1};
            orderFood['allplus']['加辣'] = plus; 
        }
        orderFoods[key] = orderFood;

    }else {
        orderFood = orderFoods[key];
        orderFood['count'] += 1;
    }
    console.log("orderFood->%o",orderFood);
    if(type == 2) {
        var e = $("#plus-");
        var copy = e.clone();
        copy.show();
        copy.attr("id","plus-" + key);
        var ss = copy.html().replace(/%id%/ig, key);
        copy.html(ss);
        $("#allplus-"+id).append(copy);
        var t = $("#plus-foodname-" + key);
        t.text(foodname + " " + x + "：");
        var e = $("#allplus-"+id);
        e.show();
    }
    $.cookie('orderFoods', JSON.stringify(orderFoods));
    //alert($.cookie('orderFoods'));

}
function reduce(id, type) {
    var i = parseInt($("#"+id).text());
    if(i == 0 || isNaN(i)) {
        return;
    }
    var x = "";
    if(i == 1) {
        x = "";
        $("#"+id).removeClass("red");
        $("#"+id+"-reduce").hide();  
    }else {
        x = i - 1;
    }
    $("#"+id).text(x);
    
    var key = id;

    if(type == 2){
        var ii = 1, lastkey = key;
        while(true){
            var xid = id + "-" + (ii);
            if(orderFoods[xid] == undefined){
                break;
            }else{
                lastkey = xid;
                ii++;
            }
        }
        key = lastkey;
        var e = $("#plus-"+key);
        e.remove();
    }
    console.log("--------%s", key);
    var orderFood = orderFoods[key];
    orderFood['count'] -= 1;
    var c = parseInt($("#allcount").text());
    var p = parseInt($("#allprice").text());
    $("#allcount").text(c - 1);
    $("#allprice").text(p - orderFood['price']);
    if(orderFood['count'] == 0){
        orderFoods[key] = undefined;
    }
    $.cookie('orderFoods', JSON.stringify(orderFoods));
}

var tabs = ['taofan', 'mixian', 'yinpin'];
function tab(t) {
    for(var i=0; i < tabs.length; i++) {
        if(t == tabs[i]) {
            location.hash = tabs[i] + "_a";   
            // $("#"+tabs[i] + "_t").className="darkred";
        }
        // else {
        //     $("#"+tabs[i] + "_t").className="";
        // }
    }
}
function showPlus(id, name){
    var e = $("#allplus-"+id);
    if(e.is(":hidden")){
        e.show();
    }else{
        e.hide();
    }
}

function selectPlus(id, price, name){
    var p = parseInt($("#allprice").text());
    if(isNaN(price)){
        price = 0;
    }
    e = "#" + id + "-" + name;
    console.log("e->%s", e);
    if($(e).hasClass("selected")){
        $(e).removeClass("selected");
        $("#allprice").text(p - price);
        var orderFood = orderFoods[id];
        orderFood['price'] -= price;
        orderFood['allplus'][name]=undefined; 
    }else{
        $("#allprice").text(p + price);
        $(e).addClass("selected");
        var orderFood = orderFoods[id];
        orderFood['price'] += price;
        var plus = {'name':name, 'price': price};
        orderFood['allplus'][name] = plus;
    }
    // var x = $("#"+id);
    $.cookie('orderFoods', JSON.stringify(orderFoods));
}

function selectMeat(id){
    var p = parseInt($("#allprice").text());
    var e = $("#meat-" + id);
    var selectedText = e.find("option:selected").text();
    var match = selectedText.match(/.*(\d+).*/);
    var price = 0;
    if(match != null){
        price = parseInt(match[1], 0);
    }
    if(isNaN(price)){
        price = 0;
    }
    match = selectedText.match(/(.*)\+.*/);
    var name = selectedText;
    if(match != null){
        name = match[1];
    }
    var oldprice = parseInt($("#meat-oldprice-" + id).val());
    if(isNaN(oldprice)){
        oldprice = 0;
    }
    $("#allprice").text(p - oldprice + price);
    $("#meat-oldprice-" + id).val(price);
    var orderFood = orderFoods[id];
    orderFood['price'] += price - oldprice;
    var plus = {'name':name, 'id':e.val()};
    orderFood['allplus']['加肉类'] = plus; 
    $.cookie('orderFoods', JSON.stringify(orderFoods));
}

function selectSpicy(id){
    var e = $("#spicy-" + id);    
    var name = e.find("option:selected").text();
    var orderFood = orderFoods[id];
    var plus = {'name':name, 'id':e.val()};
    orderFood['allplus']['加辣'] = plus; 
    $.cookie('orderFoods', JSON.stringify(orderFoods));
}

function checkSubmit() {
    // alert($("#"+'allprice').innerHTML);
    if(parseInt($("#allprice").text()) < 30) {
        var r = confirm('温馨提示，未满30元需要加5元运费！继续吗？');
        if(!r) return false;
    }
    //things
    var plusMap = {};
    for(var key in orderFoods){
        if(key.indexOf('-') > 0){
            var foodid = key.substring(0, key.indexOf('-'));
            var allplus = orderFoods[key]['allplus'];
            var pk = [];
            for(var kk in allplus){
                pk.push(allplus[kk]);
            }
            pk.sort();
            var pkid = foodid + JSON.stringify(pk);
            if(pkid in plusMap) {
                orderFoods[plusMap[pkid]].count ++;
                orderFoods[key] = undefined;
                $.cookie('orderFoods', JSON.stringify(orderFoods));
            }else{
                plusMap[pkid] = key;
            } 
        }
    }

    //alert(JSON.stringify(plusMap));

    $("#"+'next11').val("下单中");$("#"+'next11').attr("disabled","disabled");    
    $("#"+'form').submit();
}
$().ready(function(){
    var ck = $.cookie('orderFoods');
    if(ck == undefined){
        return;
    }
    oFoods = JSON.parse(ck);
    if(oFoods != undefined) {
        nIndexMap = {};
        for(var key in oFoods){
            var of = oFoods[key];
            console.log(of);
            var xkey = key, x=0;
            if(key.indexOf('-') > 0) {
                xkey = key.substring(0, key.indexOf('-'));
                x = parseInt(key.substring(key.indexOf('-')+1));
            }
            if(!(xkey in nIndexMap)){
                nIndexMap[xkey] = 0; 
            }
            for(var i=0; i<of['count']; i++){
                selectFood(xkey, of['oprice'], of['name'], of['type']);
                var allplus = of['allplus'];
                nIndexMap[xkey] += 1;
                var kk = xkey + "-" + (nIndexMap[xkey]);
                for(var ak in allplus){
                    if(ak != '加辣' && ak != '加肉类'){
                        selectPlus(kk, allplus[ak]['price'], allplus[ak]['name']);
                    }
                    if(ak == '加肉类'){
                        $("#meat-" + kk).val(allplus[ak]['id']);
                        $("#meat-" + kk).change();
                    }
                    if(ak == '加辣'){
                        $("#spicy-" + kk).val(allplus[ak]['id']);
                        $("#spicy-" + kk).change();
                    }
                }
            }
        }
    }
});