@extends('orderlistlayout')

@section('orderList')
    @foreach($orders as $index => $order)
        @if($order != end($orders))
        	@if($index == 0)
        	<div class="row first">
        	@else
        	<div class="row others">
        	@endif
        		<a href="/order/orderdetail?orderno={{$order->order_no}}">
        			<div class="no">{{ $order->order_no }}</div>
        		</a> 
        		<div class="st">{{ $order->status }} </div>
        		<div class="pay">{{ $order->pay_status }} </div>
        	</div>
    		<hr>
    	@endif
    @endforeach
@stop

<!-- @section('total')
{{count($orders)}} 单
@stop -->