@extends('vip/viplayout')


@section('vipno')
NO. {{$attr['vipno']}}
@stop

@section('balance')
(余额：{{$attr['balance']}} RMB)
@stop
