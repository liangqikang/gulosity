@extends('/admin/orders1layout')

@section('orderList')
    <!-- 共：{{count($orders)}} 单 -->
    @foreach($orders as $index => $order)
        <div class="row" onclick="javascript:location.href='orderdetail?orderno={{$order->order_no}}'">
            <div class="id">{{$order->num}}</div>
            <a href="orderdetail?orderno={{$order->order_no}}">
                <div class="no">{{ $order->order_no }}</div>
            </a> 
            <div class="od">{{ date('Y-m-d H:i:s',strtotime('+8 hours',strtotime($order->created_at))) }} </div>
            <div class="st">{{ $order->status }} </div>
            <div class="pay">{{ $order->pay_status }} </div>
            <div class="operator">{{ $order->operator }} </div>
        </div>
        @if($order != end($orders))
    		<hr>
    	@endif
    @endforeach
@stop

@section('type')
{{$type}}
@stop

@section('count')
{{$NOT_FINISHED}}
@stop

@section('leftbar')
	<div id="NOT_FINISHED" onclick="location.href='/admin/orders?type=NOT_FINISHED'">客人来的订单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="n1">{{$NOT_FINISHED}}</span></div>
    <div id="MAKING" onclick="location.href='/admin/orders?type=MAKING'">制作中的订单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="n2">{{$MAKING}}</span></div>
    <div id="DELIVERYING" onclick="location.href='/admin/orders?type=DELIVERYING'">配送中的订单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="n4">{{$DELIVERYING}}</span></div>
    <div id="FINISHED" onclick="location.href='/admin/orders?type=FINISHED'">已完成的订单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="n2">{{$FINISHED}}</span></div>
    <div id="CANCELED" onclick="location.href='/admin/orders?type=CANCELED'">已取消的订单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="n3">{{$CANCELED}}</span></div>
    <div id="VIP" onclick="location.href='/admin/vip?type=PAY'">会员中心管理&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="n5">{{$RESETPWD}}</span></div>
    <p>操作员：{{$admin}}&nbsp;&nbsp;<a href="/admin/quit"> 退出 </a> 
        <br>
    <a href="/admin/reset"> 修改密码 </a> </p>
@stop
