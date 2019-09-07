@extends("WebPublic.public")
@section('web')

<script src="/static/web/js/jquery.min.1.8.2.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/web/js/slide.js"></script>
<script src="/static/web/js/common_js.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.foucs.js" type="text/javascript"></script>

<script>$("#Navigation").slide({titCell:".Navigation_name li"});$("#Navigation").next().style.display="block"</script>
<!--幻灯片样式-->
<div class="AD_bg_img">
 <!--幻灯片样式-->
	  <div class="slider">
	   <div id="slideBox" class="slideBox">
			<div class="hd">
				<ul></ul>
			</div>
			<div class="bd">
				<ul>
					<li><a href="#" target="_blank"><img src="/static/web/images/AD_img.png" /></a></li>
			        <li><a href="#" target="_blank"><img src="/static/web/images/AD_img.png" /></a></li>
				</ul>
			</div>
			<a class="prev" href="javascript:void(0)"></a>
			<a class="next" href="javascript:void(0)"></a>
		</div>
		<script type="text/javascript">
		jQuery(".slideBox").slide({titCell:".hd ul",mainCell:".bd ul",autoPlay:true,autoPage:true,interTime:9000});
		</script>
	  </div>   
</div>
<!--手风琴效果-->
<div class="recommend_style ">
 <em class="ye_img"></em>
<div class="mian">
 <div class="title_name"><a href="#" class="link_name">最新促销</a></div>
 <div class="carouFredSel">
 <script type="text/javascript" src="/static/web/js/slider.js"></script>
 <div id="center">
 <div id="slider">
   <div class="slide">
    <a href="#" title="酒店会所设计" target="_blank"><img class="diapo" border="0" src="/static/web/images/pic1.jpg" style="opacity: 1; visibility: visible;"></a>
   <div class="backgroundText_name" >
    <div class="product_info">
     <h2>绿色有机莲花白</h2>
     <h5>产地：吐鲁番</h5>
     <p>原价：<b>￥653</b></p>
     </div>
     <div class="product_price">
     <a href="#" class="price_btn">
     <p class="left_title_p"></p>
     <p class="zj_bf"><em>￥</em>29.90</p>
     <p class="right_buf"></p>
     </a>
     </div>
   </div>
    <div class="text"></div>
   </div>
   <div class="slide" >
   <a href="#" title="办公空间设计" target="_blank"><img class="diapo" border="0" src="/static/web/images/pic2.jpg" style="opacity: 0.7; visibility: visible;"></a>
     <div class="backgroundText_name" >
    <div class="product_info">
     <h2>绿色有机莲花白</h2>
     <h5>产地：吐鲁番</h5>
     <p>原价：<b>￥653</b></p>
     </div>
     <div class="product_price">
     <a href="#" class="price_btn">
     <p class="left_title_p"></p>
     <p class="zj_bf"><em>￥</em>29.90</p>
     <p class="right_buf"></p>
     </a>
     </div>
   </div>
    <div class="text"></div>
   </div>
   <div class="slide" >
   <a href="#" title="地产样板房设计" target="_blank"><img class="diapo" border="0" src="/static/web/images/pic3.jpg" style="opacity: 0.7; visibility: visible;"></a>
     <div class="backgroundText_name" >
    <div class="product_info">
     <h2>绿色有机莲花白</h2>
     <h5>产地：吐鲁番</h5>
     <p>原价：<b>￥653</b></p>
     </div>
     <div class="product_price">
     <a href="#" class="price_btn">
     <p class="left_title_p"></p>
     <p class="zj_bf"><em>￥</em>29.90</p>
     <p class="right_buf"></p>
     </a>
     </div>
   </div>
   <div class="text"></div>
   </div>
   <div class="slide">
   <a href="#" title="豪宅别墅设计" target="_blank"><img class="diapo" border="0" src="/static/web/images/pic4.jpg" style="opacity: 0.7; visibility: visible;"></a>
     <div class="backgroundText_name" >
    <div class="product_info">
     <h2>绿色有机莲花白</h2>
     <h5>产地：吐鲁番</h5>
     <p>原价：<b>￥653</b></p>
     </div>
     <div class="product_price">
     <a href="#" class="price_btn">
     <p class="left_title_p"></p>
     <p class="zj_bf"><em>￥</em>29.90</p>
     <p class="right_buf"></p>
     </a>
     </div>
   </div>
   <div class="text"></div>
   </div>
   </div>
   </div>
<script type="text/javascript">/* ==== start script ==== */
slider.init();
</script>
 </div>  
</div>
 <em class="ye_img1"></em>
</div>
<!--最新上架产品样式-->
 <div class="new_products clearfix">
   <div class="mian">
    <div id="slideBox_list" class="slideBox_list">
     <div class="hd">
	  <div class="title_name"></div>
	  <div class="list_title"><ul><li><h3>01</h3><a href="#">水果</a></li><li><h3>02</h3><a href="#">蔬菜</a></li><li><h3>03</h3><a href="#">干果</a></li><li><h3>04</h3><a href="#">其他</a></li></ul></div>
    </div>
    
    <div class="bd">
     <div class="fixed_title_name">
      <span>新鲜</span>
     </div>
      <ul class="">
      <li class="advertising">
       <div class="AD1"><a href="#"><img src="/static/web/images/product_AD_10.png" /></a></div>
       <div class="AD2"><a href="#"><img src="/static/web/images/product_AD_14.png" /></a><a href="#"><img src="/static/web/images/product_AD_07.png" /></a></div>
       <div class="AD3"><a href="#"><img src="/static/web/images/product_AD_11.png" /></a></div>
       </li>      
       <li class="advertising">
        <div class="AD1"><a href="#"><img src="/static/web/images/product_AD_10.png" /></a></div>
       <div class="AD2"><a href="#"><img src="/static/web/images/product_AD_07.png" /></a><a href="#"><img src="/static/web/images/product_AD_14.png" /></a></div>
       <div class="AD3"><a href="#"><img src="/static/web/images/product_AD_11.png" /></a></div>      
     </li>
      <li class="advertising">
        <div class="AD1"><a href="#"><img src="/static/web/images/product_AD_10.png" /></a></div>
       <div class="AD2"><a href="#"><img src="/static/web/images/product_AD_14.png" /></a><a href="#"><img src="/static/web/images/product_AD_07.png" /></a></div>
       <div class="AD3"><a href="#"><img src="/static/web/images/product_AD_11.png" /></a></div>     
     </li> 
     <li class="advertising">
       <div class="AD1"><a href="#"><img src="/static/web/images/product_AD_10.png" /></a></div>
       <div class="AD2"><a href="#"><img src="/static/web/images/product_AD_14.png" /></a><a href="#"><img src="/static/web/images/product_AD_07.png" /></a></div>
       <div class="AD3"><a href="#"><img src="/static/web/images/product_AD_11.png" /></a></div>     
     </li>
     </ul>     
    </div>
   </div>
    <script type="text/javascript">jQuery(".slideBox_list").slide({mainCell:".bd ul"});</script>
  </div>
 </div>
 <!--产品推荐样式-->
 <div class="p_Slideshow">
  <div class="mian">
   <div class="title_style">
    <div class="title_img"></div>
    <div class="title_link_name">
     <a href="#">火龙果</a>
     <a href="#">香蕉</a><a href="#">红心蜜柚</a><a href="#">柠檬</a><a href="#">火龙果</a><a href="#">猕猴桃</a><a href="#">红心蜜 </a><a href="#">柠檬火龙果</a><a href="#">西瓜 </a><a href="#">红心蜜柚</a>
    </div>
   </div> 
  </div> <!--幻灯片样式-->
    <div id="main">   
        <div id="index_b_hero">
         <div class="title_img"></div>
            <div class="hero-wrap">
                <ul class="heros clearfix">
                  @foreach($pic as $pics)
                  <li class="hero"><img src="{{$pics->url}}" class="thumb" alt="" /> 
                  @endforeach
                </ul>
            </div>
            <div class="helper">
                <div class="mask-left">
                </div>
                <div class="mask-right">
                </div>
                <a href="javascript:void(0)" class="prev icon-arrow-a-left"></a>
                <a href="#javascript:void(0)" class="next icon-arrow-a-right"></a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.foucs({ direction: 'right' });
    </script> 
 </div>
<!--底部样式-->

@endsection
@section('title','易田首页')
