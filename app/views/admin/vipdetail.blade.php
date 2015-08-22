@extends('admin/vipdetaillayout')

@section('vipDetail')
    <p>会员卡号：{{$vip['mobile']}}</p>
    <p>注册时间：{{date('Y-m-d H:i:s',strtotime('+8 hours',strtotime($vip['created_at'])))}}</p>
    <p>注册邮箱：{{$vip['email']}}</p>
@stop

@section('paylogs')
    <p>会员余额：{{$vip['balance']}} 元</p>
    <p>会员近期账单</p>
    @if($paylogs != null)
        @foreach($paylogs as $index => $paylog)
            <p>{{date('Y-m-d H:i:s',strtotime('+8 hours',strtotime($paylog['created_at'])))}} &nbsp;&nbsp;  
                @if($paylog['type']>0)
                +{{$paylog['money']}} 
                @else
                {{$paylog['type'] * $paylog['money']}} 
                @endif
            </p>
        @endforeach
    @endif
@stop

@section('vipno')
会员管理中心  &nbsp;&nbsp;>>&nbsp;&nbsp; {{$vip['mobile']}}
@stop

@section('admin')
{{$admin}}
@stop
