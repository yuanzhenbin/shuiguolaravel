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
<!--用户中心(积分)-->
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
    <!--右侧内容样式-->
     <div class="user_right">
      <div class="user_Borders">
      <div class="title_name">
        <span class="name">用户积分</span>
       </div>
       <!--积分样式-->
       <div class="user_integral_style slideTxtBox">
         <div class="hd">
          <ul>
           <LI>剩余积分</LI>
           <li>积分订单</li>
          </ul>
         </div>
         <div class="bd">
           <ul>
           <div class="Integral_Number"><em></em>我的积分：<b>{{$jifen}}</b></div>
           </ul>
           <ul>
            <table>
             <thead>
               <tr>
                <td>商品名</td>
                <td>消耗积分</td>
                <td>下单时间</td>
                <td>物流状态</td>
               </tr>
             </thead>
             <tbody>
              @foreach($data as $row)
              <tr>
               <td>{{$row->jifen_name}}</td>
               <td>{{$row->total}}</td>
               <td>{{$row->addtime}}</td>
               <td>
                @if($row->status == 1)
                  已发货
                @else
                  等待发货
                @endif
               </td>
              </tr>
              @endforeach
             </tbody>
            </table>
           </ul>
         </div>
       </div>
       <script>jQuery(".slideTxtBox").slide({trigger:"click"});</script>
      </div>
     </div>    
  </div>
</div>
<!--底部样式-->
@endsection
@section('title','我的积分')
