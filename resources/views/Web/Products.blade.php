@extends("WebPublic.public")
@section('web')

<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
<!---->
<div class="AD_img"><a href="#"><img src="/static/web/images/AD_page_img_02.png"  width="100%"/></a></div>
<!--位置-->
<div class="Bread_crumbs">
 <div class="Inside_pages clearfix">
   <div class="left">当前位置：<a href="/index">首页</a>&gt;<a href="/Products">所有果蔬</a></div>
   <div class="right Search">
   <form action="/search" method="get">
    <input name="keywords" type="text"  class="Search_Box" placeholder="输入商品名"/>
    <input type="submit" value="" class="Search_btn"/>
   </form>
   </div>
 </div>
</div>
<!--产品-->
<div class="Inside_pages">
  <!--水果馆-->
  <div class="fruits_Forum">
    <div class="title_style">
     <div class="title_name"><a href="/Products_list/{{$data[0]->id}}"><div class="title_img_p" style="color: #fff; font-size: 30px; margin-left: 30px; line-height: 140px;">进入{{$data[0]->type_name}}馆</div></a></div>
     <div class="title_info">
      <p class="title_x_name">[健康水果小知识]</p>
      <p class="x_info">水果是指多汁且大多数有甜味可直接生吃的植物果实，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
     </div>
     <div class="title_img"><img src="/static/web/images/sg_pro_img_17.png" /></div>
    </div>
    <div class="list_style">
      <ul class="clearfix">
      @foreach($sg as $v1)
       <li class="clearfix">
       <div class="product_lists clearfix">
        @if(session("shoucang"))
        @if(in_array($v1->id,session("shoucang"))) 
          <a herf="" class="Collect" style=" background: url(/static/web/images/Complex_img.png) no-repeat; background-position: right -17px; top: 210px;"></a> 
          @else 
            <a href="/collection/{{$v1->id}}" class="Collect" style=" top: 210px;"></a> 
          @endif<!-- 收藏按钮 -->
        @else
         <a href="/collection/{{$v1->id}}" class="Collect" style=" top: 210px;"></a>
        @endif
        <a href="/Product_detailed/{{$v1->id}}"><img style="width: 207px; height: 219px;" src= @if(empty($v1->pic)) "/static/web/images/product_img_17.png" @else {{$v1->pic}} @endif /></a>
        <p class="title_p_name" style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">{{$v1->goods_name}}</p>
        <p class="title_Profile" title="{{$v1->describe}}" style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">{{$v1->describe}}</p>
        <p class="price"><b>￥</b>{{$v1->price}}</p>
        <p class="btn_style"><a href="/Product_detailed/{{$v1->id}}"  style="display: inline-block; float: right; width: 88px; height: 33px; background: #70b701; border-radius: 4px; color: #fff; text-align: center; line-height: 33px;">进去看看</a></p>
        </div>
       </li>
      @endforeach
      </ul>   
    </div>  
  </div>
        
    <!--蔬菜馆-->
  <div class="vegetables_Forum">
    <div class="title_style">
     <div class="title_name"><a href="/Products_list/{{$data[1]->id}}"><div class="title_img_p" style="color: #fff; font-size: 30px; margin-left: 80px; line-height: 140px;">进入{{$data[1]->type_name}}馆</div></a></div>
     <div class="title_info">
      <p class="title_x_name">[健康蔬菜小知识]</p>
      <p class="x_info">蔬菜是指多汁且大多数有甜味可直接生吃的植物，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
     </div>
     <div class="title_img"><img src="/static/web/images/title_p_img_32.png" /></div>
    </div>
    <div class="list_style">
      <ul class="clearfix">
      @foreach($sc as $v2)
       <li class="clearfix">
       <div class="product_lists clearfix">
        @if(session("shoucang"))
        @if(in_array($v2->id,session("shoucang"))) 
          <a herf="" class="Collect" style=" background: url(/static/web/images/Complex_img.png) no-repeat; background-position: right -17px; top: 210px;"></a> 
          @else 
          <a href="/collection/{{$v2->id}}" class="Collect" style=" top: 210px;"></a> 
          @endif<!-- 收藏按钮 -->
        @else
        <a href="/collection/{{$v2->id}}" class="Collect" style=" top: 210px;"></a>
        @endif
        <a href="/Product_detailed/{{$v2->id}}"><img style="width: 207px; height: 219px;" src= @if(empty($v2->pic)) "/static/web/images/product_img_17.png" @else {{$v2->pic}} @endif /></a>
        <p class="title_p_name" style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">{{$v2->goods_name}}</p>
        <p class="title_Profile" title="{{$v2->describe}}" style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">{{$v2->describe}}</p>
        <p class="price"><b>￥</b>{{$v2->price}}</p>
        <p class="btn_style"><a href="/Product_detailed/{{$v2->id}}"  style="display: inline-block; float: right; width: 88px; height: 33px; background: #70b701; border-radius: 4px; color: #fff; text-align: center; line-height: 33px;">进去看看</a></p>
        </div>
       </li>
      @endforeach
      </ul>   
    </div>  
  </div>
  <!--干果馆-->
   <div class="fruits_Forum">
    <div class="title_style">
     <div class="title_name"><a href="/Products_list/{{$data[2]->id}}"><div class="title_img_p" style="color: #fff; font-size: 30px; margin-left: 30px; line-height: 140px;">进入{{$data[2]->type_name}}馆</div></a></div>
     <div class="title_info">
      <p class="title_x_name">[健康干果小知识]</p>
      <p class="x_info">干果是指干化且大多数有甜味可直接生吃的植物果实，不但含有丰富的营养且能够帮助消化。水果是对部分可以食用的植物果实和种子的统称。水果有降血压、减缓衰老、减肥瘦身、皮肤保养、 明目、抗癌、降低胆固醇补充维生素等保健作用。</p>
     </div>
     <div class="title_img"><img src="/static/web/images/sg_pro_img_17.png" /></div>
    </div>
    <div class="list_style">
      <ul class="clearfix">
       @foreach($gg as $v3)
       <li class="clearfix">
       <div class="product_lists clearfix">
       @if(session("shoucang"))
        @if(in_array($v3->id,session("shoucang"))) 
          <a herf="" class="Collect" style=" background: url(/static/web/images/Complex_img.png) no-repeat; background-position: right -17px; top: 210px;"></a> 
        @else 
          <a href="/collection/{{$v3->id}}"  target="_blank"  class="Collect" style=" top: 210px;"></a> 
        @endif<!-- 收藏按钮 -->
       @else
        <a href="/collection/{{$v3->id}}" class="Collect" style=" top: 210px;"></a>
       @endif
        <a href="/Product_detailed/{{$v3->id}}"><img style="width: 207px; height: 219px;" src= @if(empty($v3->pic)) "/static/web/images/product_img_17.png" @else {{$v3->pic}} @endif /></a>
        <p class="title_p_name" style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">{{$v3->goods_name}}</p>
        <p class="title_Profile" title="{{$v3->describe}}" style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">{{$v3->describe}}</p>
        <p class="price"><b>￥</b>{{$v3->price}}</p>
        <p class="btn_style"><a href="/Product_detailed/{{$v3->id}}"  style="display: inline-block; float: right; width: 88px; height: 33px; background: #70b701; border-radius: 4px; color: #fff; text-align: center; line-height: 33px;">进去看看</a></p>
        </div>
       </li>
      @endforeach
      </ul>   
    </div>  
  </div> 
</div>
<!--底部样式-->
@endsection
@section('title','所有果蔬')
