@extends('orderlayout')


@section('address')
    <div class="subtitle">配送地址</div>
    <div class="addrbox" id="theaddr">
    @if($attr['address'] != null)
        <div class="addrcontent" onclick="javascript:chooseAddr({{$attr['address']->id}})">
            <div>{{$attr['address']->user_name}} &nbsp;&nbsp; {{$attr['address']->tel}}</div>
            <div>{{$attr['address']->address}}</div>
            <input type="hidden" name="addressid" id="addressid" value="{{$attr['address']->id}}"/>
        </div>
        <div class="newaddr">
            <div> > </div>
        </div>
    @else
        <p><a href="javascript:addOrEditAddr(1,true)">请添加配送地址 》 </a></p>
    @endif
    </div>
@stop

@section('prize')
{{$attr['prize']}}
@stop

@section('tester')
    @if($attr['user']->id < 10)
1
    @else
2
    @endif
@stop


@section('submitBtn')
    <input type="button" style="font-size:14px; font-weight:bold" id="submitbtn" onClick="javascript:checkSubmit();" value="应付总额：0元&nbsp;&nbsp;&nbsp;&nbsp; 提交订单"/> 
@stop

