@extends('chooseaddresslayout')

@section('addrs')
    @if(count($addrs) > 0)
        @foreach($addrs as $index => $addr)
        <div class="addrbox">
            <a href="chooseaddress">
                <div class="addrcontent">
                    <div>{{$addr->user_name}} &nbsp;&nbsp; {{$addr->tel}}</div>
                    <div>{{$addr->address}}</div>
                    <input type="hidden" name="addressid" id="addressid" value="{{$addr->id}}"/>
                </div>
                <div class="newaddr">
                    <div> > </div>
                </div>
            </a>
        </div>
        <div class="editbar">
            <div class="del" onclick="javascript:delete({{$addr->id}})">删除</div>
            <div class="edit" onclick="">编辑</div>
        </div>
        @endforeach
    @endif
@stop
