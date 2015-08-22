@extends('/vip/vippaylistlayout')

@section('orderList')
    @if(!empty($paylogs))
    @foreach($paylogs as $index => $paylog)
        @if($paylog != end($paylogs))
            @if($index == 0)
            <div class="row first">
            @else
            <div class="row others">
            @endif
                <div class="no">{{ $paylog->created_at }}</div>
                @if($paylog->type == 1)
                    <div class="st">+{{ $paylog->money * $paylog->type}} </div>
                @else
                    <div class="st">{{ $paylog->money * $paylog->type}} </div>
                @endif
            </div>
            <hr>
        @endif
    @endforeach
    @endif
@stop
