@extends("WebPublic.public")
@section('web')
<script src="/static/web/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.reveal.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.sumoselect.min.js" type="text/javascript"></script>
<script src="/static/web/js/common_js.js" type="text/javascript"></script>
<script src="/static/web/js/footer.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.jumpto.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
</head>
 <script type="text/javascript">
    $(document).ready(function () {
        window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3 });
        window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
    });
  </script>
<body>
<!--顶部样式-->
<div id="Orders" class="Inside_pages  clearfix">
  <div class="Orders_style clearfix">
    <div class="shop_cart">
     <div class="schedule" style="background-position: 100px 100px;"></div>
    </div>
    <form class="form" action="/jifenorders" method="post"> 
    <input name="id" type="hidden" value="{{$data->id}}" class="submit_btn"/>
     <div class="address clearfix">
       <div class="title">收货人信息</div>
        <div class="adderss_list clearfix">
          <div class="title_name">选择收货地址 <a href="/user_address">+添加地址</a></div>
           <div class="list" id="select">
           @foreach($address as $value)
            <label for="address{{$value->id}}">
              <ul class="">
                <div class="adderss_operating">
                 <div class="Operate">
                  <!-- 删除地址 -->
                  <a style="margin-left: 180px; margin-top: -60px;" href="/deladd/{{$value->id}}" class="delete_btn"></a>
                 </div>
                </div>
                <div class="user_address" style="position: relative;">
                <li>{{$value->name}}</li>
                <li>{{$value->city}}</li>
                <li>{{$value->phone}}</li>
                <input type="radio" name="address" id="address{{$value->id}}" value="{{$value->id}}" data-labelauty="选择" style="position: absolute; top: 100px; left: 10px;">
                </div>
              </ul>
            </label>
           @endforeach
          </div>
        </div>
     </div> 

    <fieldset> 
     <div class="Product_List">
      <table>
       <thead><tr class="title"><td class="name">商品名称</td><td class="price">商品价格</td>
       <tbody>
       <tr>
        <td class="Product_info">
         <a href="/Product-detailed/{{$data->id}}"><img style="width: 100px; height: 100px;" src= @if(empty($data->jifen_pic)) "/static/web/images/product_img_17.png" @else {{$data->jifen_pic}} @endif /></a>
         <a href="/Product-detailed/{{$data->id}}" class="product_name">{{$data->jifen_name}}</a>
         </td>
        <td>{{$data->jifen_price}}积分</td>
       </tr>
       </tbody>
      </table>
      <!--价格-->
      <div class="price_style">
      <div class="right_direction">
        <ul>
         <li><label>配&nbsp;&nbsp;送&nbsp;&nbsp;费</label><span>免配送费</span></li>  
        </ul>   
        <div class="btn">
        {{csrf_field()}}
          <input name="submit" type="submit" value="立即购买" class="submit_btn"/> 
          <a href="/integral" title=""><input type="button" value="返回活动专区"  class="return_btn"/></a>
        </div>
      </div>
      </div>
     </div> 
     </fieldset>
    </form>
  </div>
</div>
<div style="height: 100px;"></div>
<script>
$(function(){
  $(':input').labelauty();
});
</script>
<!--底部样式-->

@endsection
@section('title','确认积分订单')
