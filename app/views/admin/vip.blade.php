@extends('/admin/viplayout')

@section('vipList')
    @foreach($vipops as $index => $vipop)
        @if($type=='RESETPWD')
            @if($vipop['status'] == 0)
            <font style="color:red">
            @else
            <font style="">
            @endif
            <div class="row" onclick="javascript:vipResetPwd({{$vipop['vipno']}},{{$index}},{{$vipop['status']}})">
        @else
            <font><div class="row" onclick="javascript:location.href='/admin/vipdetail?vipno={{$vipop['vipno']}}'">
        @endif
            <div class="id">{{$vipop['vipno']}}</div>
            <div class="time">{{ date('Y-m-d H:i:s',strtotime('+8 hours',strtotime($vipop['time']))) }} </div>
            <div class="op">{{ $vipop['op'] }}</div>
        </div>
        </font>
        @if($vipop != end($vipops))
    		<hr>
    	@endif
    @endforeach
@stop

@section('type')
{{$type}}
@stop

@section('count')
{{$RESETPWD}}
@stop

@section('leftbar')
	<div id="RESETPWD" onclick="location.href='/admin/vip?type=RESETPWD'">会员找回密码申请&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="n1">{{$RESETPWD}}</span></div>
    <div id="PAY" onclick="location.href='/admin/vip?type=PAY'">会员最新支付动态&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="n2"></span></div>
    <div id="RECHARGE" onclick="location.href='/admin/vip?type=RECHARGE'">会员最新充值动态&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="n4"></span></div>
    <div id="search">
        <input id="vipno" name="vipno" placeholder="输入会员号"/>

        <span id="ss" onclick="javascript:search()">搜索</span></div>
    
    <p>操作员：{{$admin}}&nbsp;&nbsp;<a href="/admin/quit"> 退出 </a> </p>
    <p><a href="/admin/reset"> 修改密码 </a> </p>
    <p><a href="/admin/orders"> 返回管理首页 </a> </p>
@stop
