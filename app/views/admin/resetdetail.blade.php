@extends('admin/resetdetaillayout')

@section('vipDetail')
    <p>会员卡号：{{$vip['mobile']}}</p>
    <p>注册时间：{{date('Y-m-d H:i:s',strtotime('+8 hours',strtotime($vip['created_at'])))}}</p>
    <p>注册邮箱：{{$vip['email']}}</p>
@stop

@section('reset')
    <p>重置后的密码：{{$reset['pwd']}} </p>
    <p>密码重置时间：{{date('Y-m-d H:i:s',strtotime('+8 hours',strtotime($reset['updated_at'])))}}</p>
@stop

@section('vipno')
会员管理中心  &nbsp;&nbsp;>>&nbsp;&nbsp; {{$vip['mobile']}}
@stop

@section('admin')
{{$admin}}
@stop
