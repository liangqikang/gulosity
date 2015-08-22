@extends('orderdetaillayout')

@section('orderDetail')
    <p>下单日期：{{date('Y-m-d H:i:s',strtotime('+8 hours',strtotime($attr['order']->created_at)))}}</p>
    <p>订单号：{{$attr['order']->order_no}}</p>
    <p>订单状态：{{$attr['order']->status}} 
        @if($attr['order']->status == '下单成功')
        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="submitbtn" onClick="javascript:checkSubmit();" value="取消订单"/></span>
        @endif
    </p>
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
    <p>支付状态：{{$attr['order']->pay_status}}</p>
    <p>
        @if($attr['order']->pay_status == '未支付' && $attr['order']->status != '已取消')
        <span><input type="button" id="pay1" onClick="javascript:gopay(1);" value="货到付款"/></span>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="pay2" onClick="javascript:gopay(2);" value="微信支付"/></span>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="pay3" onClick="javascript:gopay(3);" value="会员支付"/></span>
        @endif
    </p>
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
'{{$attr['order']->order_no}}'
@stop
