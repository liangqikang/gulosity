@extends('admin/orderdetaillayout')

@section('orderDetail')
    <p>当天编号：{{$attr['order']->num}}</p>
    <p>下单日期：{{date('Y-m-d H:i:s',strtotime('+8 hours',strtotime($attr['order']->created_at)))}}</p>
    <p>订单号：{{$attr['order']->order_no}}</p>
    <p>订单状态：{{$attr['order']->status}} </p>
    <input type="hidden" name="orderno" id="orderno" value="{{$attr['order']->order_no}}">
@stop

@section('foodContent')
    @if($attr['rice'] != null)
        @foreach($attr['rice'] as $index => $food)
            <p>{{ $food->name }} &nbsp;&nbsp; ╳ {{$food->count}} </p>
        @endforeach
    @endif  
    @if($attr['noodles'] != null)
        @foreach($attr['noodles'] as $index => $food)
            <p>{{ $food->name }}
            ({{$food->allplus}})
             &nbsp;&nbsp; ╳ {{$food->count}} </p>
        @endforeach
    @endif
    @if($attr['drink'] != null)
        @foreach($attr['drink'] as $index => $food)
            <p>{{ $food->name }} &nbsp;&nbsp; ╳ {{$food->count}} </p>
        @endforeach
    @endif
@stop

@section('pay')
    <p>总计金额：{{round($attr['money'],2)}} 元</p>
    <p>中奖优惠：{{$attr['prize']}} 元（已从总金额里扣减）</p>
    <p>支付状态：{{$attr['order']->pay_status}}</p>
    @if($attr['order']->fapiao_type!=0)
    <p>发票抬头：
        @if($attr['order']->fapiao_type==1)
        个人
        @elseif($attr['order']->fapiao_type==2)
        {{$attr['order']->fapiao_title}}
        @endif
    </p>
    @endif

    @if(!empty($attr['order']->comment))
    <hr>
    <p>客官提醒：{{$attr['order']->comment}} </p>
    @endif
@stop

@section('address')
    <p>配送时间：
        @if($attr['order']->delivery_time=='0')
        立即送餐
        @else
        {{$attr['order']->delivery_time}}
        @endif
    </p>
    <p>配送地址：</p>
    @if($attr['address'] != null)
        <p>{{$attr['address']->user_name}} &nbsp;&nbsp; {{$attr['address']->tel}}</p>
        <p>{{$attr['address']->address}}</p>
    @endif
@stop

@section('orderno')
{{$attr['type']}}  &nbsp;&nbsp;>>&nbsp;&nbsp; {{$attr['order']->order_no}}
@stop

@section('admin')
{{$attr['admin']}}
@stop

@section('cancel')
    @if($attr['order']->status == '下单成功')
    
        <b><input class="submitbtn" type="button" id="submitbtn" onClick="javascript:checkSubmit(1);" value="修改状态为：制作中"/></b>
        <b><input class="submitbtn" type="button" id="submitbtn" onClick="javascript:checkSubmit(-1);" value="修改状态为：订单取消"/></b>

    @endif
    @if($attr['order']->status == '配送中')

        <b><input class="submitbtn" type="button" id="submitbtn" onClick="javascript:checkSubmit(3);" value="修改状态为：订单完成"/></b>

    @endif
    @if($attr['order']->status == '制作中')

        <b><input class="submitbtn" type="button" id="submitbtn" onClick="javascript:checkSubmit(2);" value="修改状态为：配送中"/></b>
        <b><input class="submitbtn" type="button" id="submitbtn" onClick="javascript:checkSubmit(-1);" value="修改状态为：订单取消"/></b>

    @endif
@stop