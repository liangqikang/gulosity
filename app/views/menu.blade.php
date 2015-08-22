@extends('menulayout')

@section('riceContent')
    @if(count($foods['rice']) > 0)
        <div id="taofan" style="display:block">
            <div class="subtitle"><span class="zhtitle">套饭</span> RICE</div>
            <div class="foodlist">
            @foreach($foods['rice'] as $index => $food)
            	<div class="row">
                    <span onclick="javascript:selectFood({{$food->id}},{{$food->price}},'{{$food->name}}',{{$food->type}})">
                        <div id="{{$food->id}}" class="count"></div>
                        @if(!empty($food->image))
                        <div class="foodname"><img src="{{$food->image}}" width="90px"/></div>
                        @else
                        <div class="foodname">&nbsp;</div>
                        @endif
                        <div class="foodprice tf"><p>{{$food->name}}</p><p class="ename">{{$food->ename}}</p></div>
                        <div class="yuan tf">{{$food->price}}元</div>
                    </span>
                    <div id="{{$food->id}}-reduce" class="reduce" onclick="javascript:reduce({{$food->id}},{{$food->type}})">—</div>
                </div>
            @if($food != end($foods['rice']))
        	    <hr>
        	@endif
            @endforeach
            <a name="mixian_a" class="target"></a>   
            </div>
        </div>
    @endif
@stop

@section('noodleContent')
    @if(count($foods['noodles']) > 0)
        <div id="mixian">
            <div class="subtitle"><span class="zhtitle">米线</span> RICE NOODLES<span class="dix">（米线汤100%骨头熬制）</span></div>
            <div class="foodlist">
            @foreach($foods['noodles'] as $index => $food)
                <div class="row" id="foodrow-{{$food->id}}">
                        <span onclick="javascript:selectFood({{$food->id}},{{$food->price}},'{{$food->name}}',{{$food->type}})">
                            <div id="{{$food->id}}" class="count"></div>
                        </span>
                        <span onclick="javascript:showPlus({{$food->id}},'{{$food->name}}')">
                            @if(!empty($food->image))
                            <div class="foodname"><img src="{{$food->image}}" height="80px"/></div>
                            @else
                            <div class="foodname">&nbsp;</div>
                            @endif
                            <div class="foodprice mx1"><p>{{$food->name}}</p><p class="ename mxe">{{$food->ename}}</p></div>
                            <div class="yuan mx1">{{$food->price}}元</div>
                        </span>
                    <div id="{{$food->id}}-reduce" class="reduce" onclick="javascript:reduce({{$food->id}},{{$food->type}})">—</div>
                    <div class="clear"></div>
                    <div class="allplus" id="allplus-{{$food->id}}">
                          
                    </div>             
                </div>
            @if($food != end($foods['noodles']))
                <hr>
            @endif
            
            @endforeach
            <a name="yinpin_a" class="target"></a>   
            </div>
        </div>
    @endif
@stop

@section('drinkContent')
    @if(count($foods['drink']) > 0)
        <div id="mixian">
            <div class="subtitle"><span class="zhtitle">饮品</span> DRINK</div>
            <div class="foodlist">
            @foreach($foods['drink'] as $index => $food)
                <div class="row">
                    <span onclick="javascript:selectFood({{$food->id}},{{$food->price}},'{{$food->name}}',{{$food->type}})">
                        <div id="{{$food->id}}" class="count"></div>
                        @if(!empty($food->image))
                        <div class="foodname"><img src="{{$food->image}}" height="80px"/></div>
                        @else
                        <div class="foodname">&nbsp;</div>
                        @endif
                        <div class="foodprice mx1"><p>{{$food->name}}</p><p class="ename mxe">{{$food->ename}}</p></div>
                        <div class="yuan mx1">{{$food->price}}元</div>
                    </span>
                    <div id="{{$food->id}}-reduce" class="reduce" onclick="javascript:reduce({{$food->id}},{{$food->type}})">—</div>
                </div>
            @if($food != end($foods['drink']))
                <hr>
            @endif
            @endforeach
            </div>
        </div>
    @endif
@stop

@section('plusRow')
    <div class="subrow" id="plus-" style="display:none">
        <div class="srtitle" id="plus-foodname-%id%"></div>
        <div class="taste">
            <div class="taste-left">口味选择：</div>
            <div class="taste-right">
                <div class="selectbox">
                    <select class="spicyselect" style="height:22px;display:inline-block" id="spicy-%id%" name="spicy-%id%" onchange="javascrip:selectSpicy('%id%')">
                        <option value="1">微辣</option>
                        <option value="2">正辣</option>
                        <option value="3">麻辣</option>
                        <option value="4">不辣</option>
                    </select>
                </div>
                <div class="normal" id="%id%-加醋" onclick="javascript:selectPlus('%id%',0,'加醋');" >加 醋</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="plus">
            <div class="plus-left">加料A类：</div>
            <div class="plus-right">
                <div class="normal" id="%id%-加青菜" onclick="javascript:selectPlus('%id%',2,'加青菜');" >加青菜+2元</div>
                <div class="normal" id="%id%-加豆芽" onclick="javascript:selectPlus('%id%',2,'加豆芽');" >加豆芽+2元</div>
                <div class="normal" id="%id%-加豆皮" onclick="javascript:selectPlus('%id%',2,'加豆皮');" >加豆皮+2元</div>
            </div>
        </div>
        <div class="plus">
            <div class="plus-left">加料B类：</div>
            <div class="plus-right">
                <div class="selectbox">
                    <select class="meatselect" id="meat-%id%" name="meat-%id%" onchange="javascrip:selectMeat('%id%')">
                        <option value="0">加肉类</option>
                        @foreach($foods['plus'] as $index => $plus)
                        <option value="{{$plus->id}}">加{{$plus->name}}+{{$plus->price}}元</option>
                        @endforeach
                    </select>
                    <input type="hidden" id="meat-oldprice-%id%" value="0"/>
                </div>
                <div class="normal" id="%id%-加米线" onclick="javascript:selectPlus('%id%',2,'加米线');">加米线+3元</div>
            </div>
        </div>
        <div class="clear"></div>
    </div> 
@stop