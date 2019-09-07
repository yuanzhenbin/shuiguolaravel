@extends("WebPublic.public")
@section('web')

<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
<!---->
<div><a href="#"><img src="/static/web/images/AD_page_img_02.png" width="100%"/></a></div>
<!--位置-->
<div class="Bread_crumbs">
 <div class="Inside_pages clearfix">
   <div class="right Search">
   <form action="/search" method="get">
    <input name="keywords" type="text"  class="Search_Box" placeholder="输入商品名"/>
    <input type="submit" value="" class="Search_btn"/>
   </form>
   </div>
 </div>
</div>
<!--购物车样式-->
<div class="Narrow">
  <div class="shop_cart">
     <div class="schedule"></div>
     <div class="cart_style">
       <div class="title_name">
        <ul>
         <li class="title_width"><label class="auto-label"><span>图片</span></label></li>
         <li class="title_width1" style="width: 400px;">商品信息</li>
         <li class="title_width">单价</li>
         <li class="title_width3">数量</li>
         <li class="title_width4">小计</li>
         <li class="title_width5">操作</li>
        </ul>
       </div>
       <div class="list_style">
        @foreach($data as $row)
         <ul class="product_cart">
         <li class="title_width2" style="width: 220px; height: 100px;">
         <a href="/Product_detailed/{{$row['id']}}" class="product_img left"><img style="width: 100px; height: 100px;" src= @if(empty($row['pic'])) "/static/web/images/product_img_17.png" @else {{$row['pic']}} @endif /></a>
         <p class="cart_content">
         <!-- <span> 礼盒装：20个装</span> -->
         </p>
         </li>
         <li class="title_width2" style="width: 240px; text-align: left; overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">{{$row['describe']}}</li>
         <li class="title_width2">￥{{$row['price']}}</li>
         <li class="title_width3">
           <div class="Numbers">
      		  <a href="/jian/{{$row['id']}}" onclick="updatenum('del');" class="jian">-</a>
      		  <input id="number" name="number" type="text" value="{{$row['num']}}" disabled="disabled" class="number_text">
      		  <a href="/jia/{{$row['id']}}" onclick="updatenum('del');" class="jia">+</a>
      		 </div>        
         </li>
         <li class="title_width4">￥{{$row['sum']}}</li>
         <li class="title_width5">
         <form action="/shopping_cart/{{$row['id']}}" method="post" style="display: inline;">
          {{csrf_field()}}
          {{method_field('DELETE')}}
          <button type="submit" style="background: #fff; border: 0px; color: red; cursor: pointer;" class="btn btn-danger del" onclick="return confirm('你确定要删除吗?');">删除</button>
         </form>
        </li>
         </ul>
         @endforeach
       </div>
     </div>
     <!--操作-->
     <div class="cart_operating clearfix">
        <div class="cart_operating_style">
           <div class="cart_price">商品总价：（不含运费）<b>￥@if(empty($total)) 0 @else {{$total}} @endif</b></div>
           <div class="cart_btn"><a href="/Orders" class="payment_btn"></a><a href="/Products" class="continue_btn"></a></div>
        </div>
     </div>
  </div>
</div>
<div style="height: 20px;"></div>
<!--底部样式-->

@endsection
@section('title','购物车')
