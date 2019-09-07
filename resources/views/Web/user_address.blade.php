@extends("WebPublic.public")
@section('web')

<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
<link href="/static/web/css/css.css" rel="stylesheet" type="text/css" />
<link href="/static/web/css/common.css" rel="stylesheet" type="text/css" />
<link href="/static/web/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script src="/static/web/js/jquery.min.1.8.2.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/web/js/slide.js"></script>
<script src="/static/web/js/common_js.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.foucs.js" type="text/javascript"></script>
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
<!--用户中心(地址管理界面)-->
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
        <span class="name">地址添加</span>
       </div>
       <div class="about_user_info">
         <form id="form1" name="form1" onsubmit="return mytijiao()" method="post" action="/user_address">   
          <div class="user_layout">
           <ul>
            <li><label class="user_title_name">收件人姓名：</label><input name="name" type="text" class="add_text"><em>*</em></li>
            <li><label class="user_title_name">省&nbsp;市&nbsp;区：
            <!-- 城级联动 -->
            </label>
            <select id="sid">
              <option value="" class="ss">--请选择--</option>
            </select>          
            <em>*</em></li>
            <li><label class="user_title_name">详细地址：</label><input name="address" type="text" class="add_text"><em>*</em></li>
            <li><label class="user_title_name">手&nbsp;机&nbsp;号：</label><input name="phone" type="text" class="add_text"><em>*</em></li>      
           </ul>
           <div class="operating_btn"><input type="submit" value="确认" class="submit—btn"></div>
           <!-- 把城市和详细地址合并为地址 -->
           <input type="hidden" name="city" value="">
           </div>
         {{csrf_field()}}
         </form>       
       </div>
       <!--地址列表-->
       <div class="Address_List">
        <div class="title_name"><span class="name">用户地址列表</span></div>
        <div class="list">
         <table style="font-size: 14px;">
         <thead>
          <td class="list_name_title0">收件人姓名</td>
          <td class="list_name_title3">手机号</td>
          <td class="list_name_title4">收货地址</td>
          <td class="list_name_title5">操作</td>
         </thead> 
         @foreach($data as $row)      
          <tr>
            <td>{{$row->name}}</td>
            <td>{{$row->phone}}</td>
            <td>{{$row->city}}</td>
            <td>
<!--               <a href="/user_address/{{$row->id}}/edit">修改</a> -->
              <form action="/user_address/{{$row->id}}" method="post">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" style="border: 0px; background: #fff; color: #ff6700; cursor: pointer;">删除</button>
              </form>
            </td>
          </tr>
          @endforeach
         </table>
        </div>
       </div>
      </div>
   </div>
 </div>
</div>

<script>
 var NAME;
  var PHONE;
  var CITY;
  var ADDRESS;
  $.get('/address',{'upid':0},function(result){
    //得到的数据数组内容
    for(var i=0;i<result.length;i++){
      //console.log(result[i].name);
      //将得到的地址名称写入到option
      var  info =  $('<option value="'+result[i].id+'">'+result[i].name+'</option>');
      //console.log(info);
      //将得到的option标签放入到select列表中
      $('#sid').append(info);
    }
    //禁止请选择被选中
    $('.ss').attr('disabled',true);
  },'json');
  //live事件委派
  $('select').live('change',function(){
    //将当前的对象存储起来
    obj = $(this);
    //通过id来查找下一个
    id = $(this).val();
    //清除所有其他的select
    obj.nextAll('select').remove();
    $.getJSON('/address',{'upid':id},function(result){
        //alert(result);
      if(result !=''){
      var select =  $('<select></select>');
      var op = $('<option class="mm">--请选择 --</option>');
      select.append(op);

      //循环输出相应城市内容
      for(var i=0;i<result.length;i++){
        //console.log(result[i].name);
        var info = $('<option value="'+result[i].id+'">'+result[i].name+'</option>');
        select.append(info);
      }
      //将select标签添加 到当前标签的后面
      obj.after(select);
      }
      $('.mm').attr('disabled','true');
    })
  });

  //获取选中的数据提交到操作页面
  function mytijiao(){
    //console.log($('select'));
    arr =[];
    $('select').each(function(){
      
      opdata=$(this).find('option:selected').html();
      
    //  console.log(opdata);
      //将我们得到的每个值放置到数组中
      arr.push(opdata);
    })

    //将 得到的数组直接赋值给隐藏域的value即可
    $('input[name=city]').val(arr);
    //alert($('input[name=city]').val());
    str = $('input[name=city]').val();
    //alert(str);
    var reg = RegExp(/-/);
    if (reg.exec(str)) {
      $('#sid').next('em').html('*请选择省 市 区');
      console.log($('#sid').next());
      $('#sid').next('em').css('color','red');
      //alert(1);
      CITY=false;
    }else {
      $('#sid').next('em').html(' ');
      $('#sid').next('em').css('color','gray');
      //alert(2);
      CITY=true;
    }
    //自动调用 input 失去焦点事件
    $("input").trigger("blur");
    //判断 PHONE NAME ADDRESS CITY 是否为 false 如果是 不能提交
    if(PHONE && NAME && ADDRESS && CITY){
      return true;//成功提交
    }else{
      return false;
    }
  }

//input 失去焦点事件
  $('input[name=name]').blur(function(){
    if ($(this).val() == '') {
      $(this).next('em').html('*请填写收件人姓名');
      $(this).next('em').css('color','red');
      NAME=false;
    }else {
      $(this).next('em').css('color','gray');
      $(this).next('em').html('用户名正确');
      NAME=true;
    }
  });

  $('input[name=phone]').blur(function(){
    var phone = $(this).val();
    if(!(/^1[34578]\d{9}$/.test(phone))){ 
      $(this).next('em').html('*请填写正确的电话');
      $(this).next('em').css('color','red');
      PHONE=false; 
    }else{
      $(this).next('em').html('电话正确');
      $(this).next('em').css('color','gray');
      PHONE=true;
    }
  });
  $('input[name=address]').blur(function(){
    if ($(this).val() == '') {
      $(this).next('em').html('*请填写详细地址');
      $(this).next('em').css('color','red');
      ADDRESS=false;
    }else {
      $(this).next('em').css('color','gray');
      $(this).next('em').html('已填写');
      ADDRESS=true;
    }
  });
  //input 获取焦点事件
  $('input[name=name]').focus(function(){
    $(this).next('em').html('*请填写收件人姓名');
  });
  $('input[name=phone]').focus(function(){
    $(this).next('em').html('*请填写正确的电话');
  });
  $('input[name=address]').focus(function(){
    $(this).next('em').html('*请填写详细地址');
  });
  //
  //
</script>
<!--底部样式-->
@endsection
@section('title','收货地址管理')