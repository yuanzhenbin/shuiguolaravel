<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
  .mystyle{}
  .mystyle ul li{float: left;}
  .mystyle span{display: block; width: 20px; height: 19px; text-align: center; line-height: 20px; padding: 10px;border: 1px solid #ddd; margin-right: 10px;}
</style>
<!-- 图标 -->
<link rel="shortcut icon" href="/static/web/images/logo.ico">
<link href="/static/web/css/css.css" rel="stylesheet" type="text/css" />
<link href="/static/web/css/common.css" rel="stylesheet" type="text/css" />
<link href="/static/web/css/Orders.css" rel="stylesheet" type="text/css" />
<link href="/static/web/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<link href="/static/web/css/common.css" rel="stylesheet" tyle="text/css" />

<script type="text/javascript" src="/static/web/js/slide.js"></script>
<script src="/static/web/js/jquery.min.1.8.2.js" type="text/javascript"></script>
<script src="/static/web/js/common_js.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script src="/static/web/js/slide.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.foucs.js" type="text/javascript"></script>
<script src="/static/web/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.reveal.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.sumoselect.min.js" type="text/javascript"></script>
<script src="/static/web/js/footer.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.jumpto.js" type="text/javascript"></script>
<script src="http://bdimg.share.baidu.com/static/api//static/web/js/share.js?v=89860593.js?cdnversion=402727"></script>
<script src="/static/web/js/easyform.js" type="text/javascript"></script>


<title>@yield('title')</title>
</head>

<body>
<!--顶部样式-->
<div class="top_header">
<em class="left_img"></em>
<div class="header clearfix" id="header">
<a href="/index" class="logo_img"><img src="/static/web/images/logo.png" /></a>
<div class="header_Section">
 <div class="shortcut">
  <ul>
    @if(session('user_name'))    
      <li  class="hd_menu_tit"><em class="login_img"></em><a href="/user">{{session("user_name")}}</a></li>
      <li  class="hd_menu_tit"><em  class="registered_img"></em><a href="/dologin">退出</a></li>
    @else
      <li  class="hd_menu_tit"><em class="login_img"></em><a href="/login">登录</a></li>
      <li  class="hd_menu_tit"><em  class="registered_img"></em><a href="/registered">注册</a></li>
    @endif
   <li  class="hd_menu_tit"><em class="Collect_img"></em><a href="/user_Collect">收藏夹</a></li>
   <li  class="hd_menu_tit"><em class="cart_img"></em><a href="/shopping_cart">购物车</a></li>
<!--    <li  class="hd_menu_tit list_name" data-addclass="hd_menu_hover"><a href="#">网站导航</a><em class="navigation_img"></em> 
    <div class="hd_menu_list">
     <span class="wire"></span>
		   <ul>
		    <li><a href="#">常见问题</a></li>
			<li><a href="#">在线退换货</a></li>
		    <li><a href="#">在线投诉</a></li>
			<li><a href="#">配送范围</a></li>
		   </ul>
		</div>	
   </li> -->
  </ul>
 </div>
 <div class="nav" id="Navigation">
  <ul class="Navigation_name"> 
   <li class=""><a href="/index" title="">首页</a></li>
   <li class=""><a href="/Products">所有果蔬</a></li>
   <li class=""><a href="/integral">活动专区</a></li>
  
   <!-- 以下三个遍历 -->
   {{$result = DB::table('goods_type')->where('pid','=',0)->paginate()}}
   @foreach($result as $value)
   <li class="xianshitest" onmouseover="$(this).children('div').show()" onmouseleave="$(this).children('div').hide()" style="position: relative;">
    <a href="/Products_list/{{$value->id}}">{{$value->type_name}}</a>
    <div class="yincangtest" style="position: absolute; top: 80px; left: 0px; background: #ff6700; display: none; z-index: 100;">
      {{$res = DB::table('goods_type')->where('pid','=',$value->id)->paginate()}}
      @foreach($res as $v)
        <a href="/Products_lists/{{$v->id}}" style="display: block; width: 83px; border-bottom:1px solid #fff; border-left: 1px solid #fff; border-right: 1px solid #fff; text-align: center;">{{$v->type_name}}</a>
      @endforeach
    </div>
   </li><!-- 这三个是遍历的一级分类 -->
   @endforeach

   <li class=""><a href="/user">会员中心</a></li>
   <!-- <li class=""><a href="#">联系我们</a></li> -->
  </ul>
 </div>
 <script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
</div>
</div>
<em class="right_img"></em>
</div>

@section('web')
@show

<!--底部样式-->
<div class="footer">
 <div class="footer_img_bg"></div>
 <div class="footerbox">
  <div class="footer_info">
    <div class="footer_left">
     <a href="#"><img src="/static/web/images/logo.png" /></a>
     <p class="erwm">
     <img src="/static/web/images/erweim.png"  width="80px" height="80px"/>
     <img src="/static/web/images/erweim.png"  width="80px" height="80px"/>
     <p>
    </div>
    <div class="helper_right clearfix">
     <dl>
      <dt><em class="guide"></em>新手指南</dt>
      <dd><a href="#">注册新用户</a></dd>
      <dd><a href="#">实名认证</a></dd>
      <dd><a href="#">找回密码</a></dd>
     </dl>
     <dl>
      <dt ><em class="h_about"></em>关于我们</dt>
      <dd><a href="#">关于我们</a></dd>
      <dd><a href="#">政策服务</a></dd>
      <dd><a href="#">常见问题</a></dd>
     </dl>
     <dl>
      <dt ><em class="h_conact"></em>联系我们</dt>
      <dd><a href="#">联系我们</a></dd>
      <dd><a href="#">在线客服</a></dd>
      <dd><a href="/weblink/create">友情链接</a></dd>
     </dl>
    </div>
  </div>
 </div> 
 <div class=" Copyright ">
   @2018 版权所有
 </div>
</div>
</body>
</html>
