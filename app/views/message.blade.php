@extends('messagelayout')

@section('msg')
{{$attr['msg']}}
@stop
     
@section('confirmBtn')
    <div class="btn" id="confirm" onclick="javascript:location.replace('{{$attr['url']}}')" >确定</div>
@stop