@extends("WebPublic.public")
@section('web')

<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
<script type="text/javascript">
  $(document).ready(function(){

		  setInterval(showTime, 1000);                                
		  function timer(obj,txt){
						  obj.text(txt);
		  }        
		  function showTime(){                                
				  var today = new Date();
				  var weekday=new Array(7)
				  weekday[0]="星期日"
				  weekday[1]="星期一"
				  weekday[2]="星期二"
				  weekday[3]="星期三"
				  weekday[4]="星期四"
				  weekday[5]="星期五"
				  weekday[6]="星期六"                                        
				  var y=today.getFullYear()+"年";
				  var month=today.getMonth()+1+"月";
				  var td=today.getDate();
				  var d=weekday[today.getDay()];
				  var h=today.getHours();
				  var m=today.getMinutes();
				  var s=today.getSeconds();        
				  timer($("#y"),y+month);
				  //timer($("#MH"),month);        
				  timer($("h1"),td);        
				  timer($("#D"),d);
				  timer($("#H"),h);
				  timer($("#M"),m);
				  timer($("#S"),s);
		  }        
  })
</script>
<body>
<!--顶部样式-->

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
<!--用户中心-->
<div class="Inside_pages clearfix">
  <div class="clearfix user" >
    <div class="user_left">
      <div class="user_info">
       <div class="Head_portrait"><img src= @if(empty(session('pic'))) "/static/web/images/product_img_17.png" @else {{session('pic')}} @endif  width="80px" height="80px"/><!--头像区域--></div>
       <div class="user_name">{{session("user_name")}}<!-- 用户名 --><a href="/user_info">[个人资料]</a></div><!-- 此处info后有一个用户id参数 -->
      </div>
      <ul class="Section">
       <!-- <li><a href="#"><em></em><span>我的特色馆</span></a></li> -->
       <li><a href="/user_info"><em></em><span>个人信息</span></a></li>
       <li><a href="/user_Password"><em></em><span>修改密码</span></a></li>
       <li><a href="/user_Orders"><em></em><span>历史订单</span></a></li>
       <li><a href="/user_pinglun"><em></em><span>我的评论</span></a></li>
       <li><a href="/user_integral"><em></em><span>我的积分</span></a></li>
       <li><a href="/user_Collect"><em></em><span>我的收藏</span></a></li>
       <li><a href="/user_address"><em></em><span>收货地址管理</span></a></li>
      </ul>
    </div>
    <div class="user_right">
     <div class="user_center_style">
     <div class="user_time">
      <h1></h1>
      <h4 id="D"></h4>
      <h4 id="y"></h4>
     </div>
      <ul class="user_center_info">
       <!-- <li>
        <img src="/static/web/images/user_img_05.png" />
        <h4 class="Money">余额￥3</h4>
       </li> -->
       <li><img src="/static/web/images/user_img_04.png" />
        <a href="#">待收货（{{$fh}}）<!-- 变量 --></a>
       </li>
       <li><img src="/static/web/images/user_img_06.png" />
        <a href="#">积分{{$data->jifen}}分<!-- 变量 --></a>
       </li>
       <li><img src="/static/web/images/user_img_03.png" />
        <a href="#">订单评价（5）<!-- 变量 --></a>
       </li>
      </ul>     
     </div>
     <div class="Order_form">
       <div class="user_Borders">
        <div class="title_name">
        <span class="name">我的订单</span>
        <a href="/user_Orders">历史订单&gt;&gt;</a>
       </div>
       <div class="Order_form_list">
         <table>
         <thead>
          <td class="list_name_title5">商品</td>
          <td class="list_name_title2">单价(元)</td>
          <td class="list_name_title2">数量</td>
          <td class="list_name_title4">付款(元)</td>
          <td class="list_name_title5">订单状态</td>
          <td class="list_name_title6">操作</td>
         </thead> 
         @foreach($orders as $row)
           <tbody>       
             <tr><td colspan="6" class="Order_form_time">{{$row->addtime}} 订单号：{{$row->code}}</td></tr>
             <tr>
             <td colspan="3">
             <table class="Order_product_style">
             @foreach($row->goods as $v)
             <tr>
             <td>
              <div class="product_name clearfix">
              <a href="/Product_detailed/{{$v->goods_id}}"><img src= @if(empty($v->pic))) "/static/web/images/product_img_17.png" @else {{$v->pic}} @endif  width="80px" height="80px"/></a>
              <a href="/Product_detailed/{{$v->goods_id}}">{{$v->goods_name}}</a>
              </div>
              </td>
              <td>{{$v->price}}</td>
              <td>{{$v->num}}</td>
              </tr>
             @endforeach
              </table>
             </td>   
             <td class="split_line">{{$row->total}}</td>
             <td class="split_line">
                @if($row->status == 1)
                  @if($row->fahuo == 1)
                    已发货
                  @else
                    请等待发货
                  @endif
                @else
                  订单已取消
                @endif
             </td>
             <td>
              @if($row->status == 1)
                  @foreach($row->goods as $v)
                     @if($v->pinglun == 0)
                     <form id="form1" name="form1" method="post" action="/comment">
                      {{csrf_field()}}
                      <input type="hidden" name="order_id" value="{{$row->id}}">
                      <input type="hidden" name="id" value="{{$v->goods_id}}">
                      <input type="submit" style="cursor: pointer; border: 0px; background: #fff; color: gray;" value="去评论"><hr/>
                     </form>
                    @else
                      已评论
                    @endif
                  @endforeach
                @else
                  无权评论
              @endif
             </td>
             </tr>
            </tbody>
            @endforeach
          <tr><td colspan="6" class="Order_form_time">更多请在历史订单查看</td></tr>
           <tr>
         </table>
       </div>
       </div>
     </div>
    </div>
  </div>
</div>
<!--底部样式-->
@endsection
@section('title','个人中心')
