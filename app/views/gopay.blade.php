@extends('gopaylayout')


@section('orderno')
"{{$attr['orderno']}}"
@stop

@section('pay_package')
{{$attr['pay_package']}}
@stop

@section('attach')
{{$attr['attach']}}
@stop
