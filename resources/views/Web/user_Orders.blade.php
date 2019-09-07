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
<!--修改密码样式-->
<div class="Inside_pages clearfix">
  <div class="clearfix user" >
  <!--左侧菜单栏样式-->
  <div class="user_left">
      <div class="user_info">
       <div class="Head_portrait"><img src= @if(empty(session('pic'))) "/static/web/images/product_img_17.png" @else {{session('pic')}} @endif  width="80px" height="80px"/><!--头像区域--></div>
       <div class="user_name">{{session("user_name")}}<!-- 用户名 --><a href="/user_info">[个人资料]</a></div>
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
    <!--右侧样式-->
    <div class="user_right">
      <div class="user_Borders">     
       <div class="title_name">
        <span class="name">历史订单</span>
       </div>
       <!--修改密码样式-->
        <div class="Order_form">
         <div class="Order_form_list">
          <div id="uid">
           <table>
           <thead>
            <td class="list_name_title0">商品</td>
            <td class="list_name_title1">单价(元)</td>
            <td class="list_name_title2">数量</td>
            <td class="list_name_title4">实付款(元)</td>
            <td class="list_name_title5">订单状态</td>
            <td class="list_name_title6">操作</td>
           </thead> 
           @foreach($data as $row)
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
              <a href="/Product_detailed/{{$v->goods_id}}" style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">{{$v->goods_name}}</a>
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
              
           </table>
          </div>
           <div class="pages_Collect clearfix mystyle" style="float: right;">
            @foreach($pp as $v)
              <a href="javascript:void(0)" onclick="page({{$v}})" title="">{{$v}}</a>
            @endforeach()
           </div>
         </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="height: 30px;"></div>

<script>
  //ajax分页
   function page(page){
    $.get('/user_Orders',{page:page},function(data){
      // alert(1);
      $('#uid').html(data);
    });
   }
</script>
@endsection
@section('title','历史订单')




     