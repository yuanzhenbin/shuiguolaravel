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
        <span class="name">我的评论</span>
       </div>
       <div class="review_listBox">
       <div class="review_list clearfix" id="page">
         <div id="uid">
         @foreach($comment as $row)
         <div style="overflow:hidden;margin-top:10px;height: 100px;width:100%;border:0px solid red;position:relative;">
           <div style="float:left;width: 100px; height: 100px; position: absolute; left: 30px;">
            <img src="{{$row->pic}}" alt="" style="width:80px; height: 80px;"><br/><span>&nbsp;&nbsp;{{$row->goods_name}}</span>
           </div>
           <div style="float: right;width:83%;border:1px solid #e0e0e0;height:98px">
            <span>{{$row->content}}</span>
           </div>
           <span style="position:absolute;bottom:5px;right:5px;">{{$row->addtime}}</span>
         </div>
        @endforeach
        </div>
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
</body>
<div style="height:100px;"></div>
<style type="text/css" media="screen">
  /* .review_list{padding-top:18px; margin-bottom:10px;border-bottom:1px rgba(128,128,128,0.5) solid;}
  .review_cont p{line-height:30px;padding-left:60px;font-size:14px;}
  .review_user{width:200px; text-align:center; margin-left:80%;}
  .review_goods{width:200px; margin-left:40px;color:rgba(126,126,126,0.4);} */
</style>
<script>
  //ajax分页
   function page(page){
    $.get('/user_pinglun',{page:page},function(data){
      // alert(1);
      $('#uid').html(data);
    });
   }
</script>
@endsection
@section('title','我的评论')
