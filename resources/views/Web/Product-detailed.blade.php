@extends("WebPublic.public")
@section('web')
<style>
  *{margin: 0; padding: 0;}
  #da{width: 350px; height: 350px; position: absolute; top: 320px; left: 860px; overflow: hidden; display: none;}
</style>
<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
<!---->
<div><a href="#"><img src="/static/web/images/AD_page_img_02.png" width="100%"/></a></div>
<!--位置-->
<div class="Bread_crumbs">
 <div class="Inside_pages clearfix">
   <div class="left">当前位置：<a href="#">首页</a>&gt;<a href="#">{{$data->goods_name}}</a></div>
   <div class="right Search">
   <form action="/search" method="get">
    <input name="keywords" type="text"  class="Search_Box" placeholder="输入商品名"/>
    <input type="submit" value="" class="Search_btn"/>
   </form>
   </div>
 </div>
</div>
<!--商品详细介绍-->
<div class="Inside_pages clearfix">
 <div class="left_style">
    <div class="title_img_p"><img src="/static/web/images/p_vegetables_img.png" /></div>
   <div class="ranking">
    <div class="ranking_title"><span>销量</span>排行</div>
    <ul class="ranking_list">
    <?php $i=1 ?>
    @foreach($commend as $row)
     <li class="">
     <em class="ranking_label">{{$i++}}</em>
     <a href="/Product_detailed/{{$row->id}}" class="img"><img src="{{$row->pic}}" width="100px" height="100px" /></a>
     <p class="ranking_name">{{$row->goods_name}}</p>
     <p class="price"><b>￥</b>{{$row->price}}</p>
     <p><a href="/Product_detailed/{{$row->id}}">立即查看</a></p>
     </li>
    @endforeach
    </ul>
   </div>
 </div>
 <!--详细介绍样式-->
 <div class="right_style">
  <div class="pro_detailed">
   <div class="Details_style clearfix" id="goodsInfo">
     <div class="mod_picfold clearfix">
    <div class="clearfix" id="detail_main_img">
  	 <div class="layout_wrap">
      <img style="width: 400px; height: 500px;" src="{{$data->pic}}" id="xiao" alt="">
      <div id="da"><img width="800px" height="1000px" src="{{$data->pic}}" alt=""></div>
  	  <!-- <img style="width: 400px; height: 500px;" src="{{$data->pic}}" alt=""> -->
  	 </div>
	  </div>
   </div>
   <!--购买信息-->
    <div class="Buying_info">
      <div class="product_name"><h2>{{$data->goods_name}}</h2></div>
      <div class="product_price">
       <div class="price"><label>商城价：</label>￥{{$data->price}}<b>元/箱</b></div>
      </div>
      <div class="productDL">
      <form action="/shopping_cart" method="post">
        <dl><dt>数&nbsp;&nbsp;量：</dt><dd class="left">
         <div class="Numbers">
    		  <a href="javascript:void(0);" style="width: 40px;" onclick="jian()" class="jian  ">-</a>
            <input id="number" name="number" type="text" value="1" class="number_text">
    		    <input name="id" type="hidden" value="{{$data->id}}">
    		  <a href="javascript:void(0);" style="width: 40px;" onclick="jia();" class="jia  ">+</a>
    		 </div>
        </dd><dd class="left Quantity">(库存：{{$data->total}})</dd></dl>
        <dl><dt>商品介绍：</dt><dd class="left Quantity">{{$data->describe}}</dd></dl>
      </div>
      <div class="product_Quantity">销量：{{$data->sales}}</div>
      <div class="operating">
      {{csrf_field()}}      
      <input type="submit" style="width: 132px; height: 50px; background: #ff6700; color: #fff; font-size: 16px; border: 0px; border-radius: 4px; cursor:pointer;" value="加入购物车"><!-- 加入购物车 -->
       </form>
      </div>
    </div>
   </div>
   <!--信息展示-->
   <div class="mainListRight" id="status1">
   <ul class="fixed_bar" style="">
      <li class="status_on active"><a href="#status1">商品评价</a></li>
      <!-- <li class="status_on"><a href="#status2">商品评价<span>(0)</span></a></li> -->
    </ul>
    <div id="uid">
      <div class="review_listBox">
        <div class="review_list clearfix">
          @foreach($comment as $row)
            <div style="overflow:hidden;margin-top:10px;height: 100px;width:100%;border:0px solid red;position:relative;">
           <div style="float:left;width: 16%;border:0px solid red;">
            <img src="{{$row->pic}}" alt="" style="width:80px;height:80px;"><br/><span>&nbsp;&nbsp;{{$row->name}}</span>
           </div>
           <div style="float: right;width:83%;border:1px solid #e0e0e0;height:98px"><span>{{$row->content}}</span></div><span style="position:absolute;bottom:5px;right:5px;">{{$row->addtime}}</span>
         </div>
         @endforeach
        </div>
      </div>
     </div>
   </div>
  </div>
 </div>
 
 <div class="pages_Collect clearfix mystyle" style="float: right;">
    @foreach($pp as $v)
      <a href="javascript:void(0)" onclick="page({{$v,$id}})" title="">{{$v}}</a>
    @endforeach()
  </div>
</div>
<div style="height: 100px;"></div>

<script type="text/javascript">
//以下是购买数量判断
  $("#number").blur(function(){
    // alert($(this).val());
    if (parseInt($(this).val()) < 1) {
      $(this).val(1);
    }else if(parseInt($(this).val()) > {{$data->total}}){
      $(this).val(parseInt({{$data->total}}));
    }
  });
  
  function jian(){
    var num = parseInt($('#number').val());
    if (num <= 1) {
      $('#number').val(1);
    }else{
      $('#number').val(num-1);
    }  
  }
  function jia(){
    var num = parseInt($('#number').val());
    if (num >= {{$data->total}}) {
      $('#number').val(parseInt({{$data->total}}));
    }else{
      $('#number').val(num+1);
    }
  }
</script>
<script>
  var da = document.getElementById('da');
  var xiao = document.getElementById('xiao');
  xiao.onmousemove = function(e){
    e = e || event;
    // console.log(e.clientX);
    // console.log(e.clientY);
    da.scrollTop = (e.clientY)*2-350;
    da.scrollLeft = (e.clientX-450)*2-175;
    da.style.display = 'block';
  }
  xiao.onmouseleave = function(){
    da.style.display = 'none';
  }
  function page(page,id){
    $.get('/Product_detailed/'.id,{page:page},function(data){
      // alert(1);
      $('#uid').html(data);
    });
   }
</script>
<!--底部样式-->
@endsection
@section('title','商品详细介绍')
