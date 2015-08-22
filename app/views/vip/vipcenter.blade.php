@extends('vip/vipcenterlayout')


@section('vipno')
会员卡号：{{$attr['vipno']}}
@stop

@section('changeVipNoBtn')
   <div class="btn" onclick="javascript:location.href='/vip/changevipno?vipno={{$attr['vipno']}}'">修改</div>
@stop

@section('balance')
{{$attr['balance']}}
@stop