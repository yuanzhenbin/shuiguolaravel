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
    <form class="form" action="/Orders" method="post"> 
    <input name="total" type="hidden" value="{{$total}}" class="submit_btn"/>
    <input name="jifen" type="hidden" value="{{$jifen}}" class="submit_btn"/>
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
                  <a style="margin-left: 180px; margin-top: -60px;" href="/deladdress/{{$value->id}}" class="delete_btn"></a>
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
     <!--付款方式-->
     <div class="payment">
      <div class="title_name">支付方式</div>
       <ul>
        <!-- <li><input type="radio" name="radio" data-labelauty="余额支付"></li> -->
        <li><input type="radio" name="zhifu" value="1" data-labelauty="支付宝"></li>
        <!-- <li><input type="radio" name="radio" data-labelauty="财付通"></li> -->
        <!-- <li><input type="radio" name="radio" data-labelauty="银联支付"></li> -->
         <li><input type="radio" name="zhifu" value="2" data-labelauty="微信支付"><em style="color: green;">*特殊通道</em></li>
       </ul>
     </div>

     <div class="Product_List">
      <table>
       <thead><tr class="title"><td class="name">商品名称</td><td class="price">商品价格</td><td class="Quantity">购买数量</td><td class="Money">金额</td></tr></thead>
       <tbody>
       @foreach($data as $row)
       <tr>
        <td class="Product_info" align="center">
         <a href="/Product-detailed/{{$row['id']}}"><img style="width: 100px; height: 100px;" src= @if(empty($row['pic'])) "/static/web/images/product_img_17.png" @else {{$row['pic']}} @endif /></a>
         <a href="/Product-detailed/{{$row['id']}}" style="text-align: center" class="product_name">{{$row['name']}}</a>
         </td>
        <td><i>￥</i>{{$row['price']}}</td>
        <td>{{$row['num']}}</td>
        <td class="Moneys"><i>￥</i>{{$row['sum']}}</td>
       </tr>
       @endforeach
       </tbody>
      </table>
      <div class="Pay_info">
       <label>订单留言</label><input name="liuyan" type="text"  onkeyup="checkLength(this);" class="text_name " />  <span class="wordage">剩余字数：<span id="sy" style="color:Red;">50</span></span>  
      </div>
      <!--价格-->
      <div class="price_style">
      <div class="right_direction">
        <ul>
         <li><label>商品总价</label><i>￥</i><span>{{$total}}</span></li>
         <li><label>配&nbsp;&nbsp;送&nbsp;&nbsp;费</label><span>免配送费</span></li>
         <li class="shiji_price"><label>实&nbsp;&nbsp;付&nbsp;&nbsp;款</label><i>￥</i><span>{{$total}}</span></li>    
        </ul>   
        <div class="btn">
        {{csrf_field()}}
          <input name="submit" type="submit" value="提交订单" class="submit_btn" onclick="return confirm('新鲜果蔬，一经发货，概不退货，您想好了吗？');"/> 
          <a href="/shopping_cart" title=""><input type="button" value="返回购物车"  class="return_btn"/></a>
        </div>
        <div class="integral right">待订单确认后，你将获得<span>{{$jifen}}</span>积分<br/>
        @if(count($errors) > 0)  
          <p style="color: red;">
            @foreach ($errors->all() as $error)
              {{ $error }}<br/>
            @endforeach
          </p>   
        @endif
        </div> 
      </div>
      </div>
     </div> 
     </fieldset>
    </form>
  </div>
</div>
<div style="height: 100px;"></div>
<script type="text/javascript">
function checkLength(which) {
	var maxChars = 50; //
	if(which.value.length > maxChars){
		alert("您出入的字数超多限制!");
		// 超过限制的字数了就将 文本框中的内容按规定的字数 截取
		which.value = which.value.substring(0,maxChars);
		return false;
	}else{
		var curr = maxChars - which.value.length; //250 减去 当前输入的
		document.getElementById("sy").innerHTML = curr.toString();
		return true;
	}
}
</script>
<script>
$(function(){
	$(':input').labelauty();
});
</script>
<!--底部样式-->

@endsection
@section('title','确认订单')
