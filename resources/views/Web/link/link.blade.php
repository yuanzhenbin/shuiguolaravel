@extends("WebPublic.public")
@section('web') 

<script src="/static/web/js/jquery.min.1.8.2.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script type="text/javascript" src="/static/web/js/slide.js"></script>
<script src="/static/web/js/common_js.js" type="text/javascript"></script>
<script src="/static/web/js/jquery.foucs.js" type="text/javascript"></script>

<script>$("#Navigation").slide({titCell:".Navigation_name li"});$("#Navigation").next().style.display="block"</script>
<script>
  $(".xianshitest").hover(function(){
      $(".xianshitest div").show();
  },function(){
      $(".xianshitest div").hide();
  });
</script>

<div><a href="#"><img src="/static/web/images/AD_page_img_02.png" width="100%"/></a></div>

<!--修改密码样式-->
<div class="Inside_pages clearfix">
  <div class="clearfix user" >
    <!--右侧样式-->
    <div class="user_right">
      <div class="user_Borders">     
       <div class="title_name">
        <span class="name">申请信息</span>
       </div>
       <!--修改密码样式-->
       <div class="about_user_info">
        <form id="form1" name="form1" method="post" action="/weblink">   
         <div class="user_layout">
           <ul >
            <li><label class="user_title_name">网站名称：</label><input name="connection_name" type="text"  class="add_text"/><em>*</em></li>
            <li><label class="user_title_name">网&nbsp;&nbsp;&nbsp;址：</label><input name="url" type="text"  class="add_text"/><em>*</em></li> 
            <li style="height: 80px;">
             申请步骤：<br/>1.做好链接后，请在右侧填写申请信息。<br/>2.已经开通我站友情链接且内容健康，符合本站友情链接要求的网站，经管理员审核后，可以显示在此友情链接页面。<br/>3.请通过此表单提交申请，注明：友情链接申请
            </li>      
           </ul>
            
           {{csrf_field()}} 
           <div class="operating_btn"><input type="submit" value="提交申请"  class="submit—btn"/></div>
           </div>
          </form>
      </div>
        <div class="title_name">
        <span class="name">友情链接</span>
        </div>
         <table style="font-size: 14px;">
         <ul>
          @foreach($data as $v)
            @if($v->status == 1)
            <li style="float: left; width: 100px; height: 50px; text-align: center; line-height: 50px;"><a href="{{$v->url}}" target="_blank">{{$v->connection_name}}</a></li>
            @endif
          @endforeach 
         </ul>
         </table>
       </div>
    </div>
  </div>
</div>
<div style="height: 100px;"></div>

<script>
 NAME=false;
 URL=false;
 $(':submit').click(function(){
  if ($('input[name=connection_name]').val() == '') {
    NAME = false;
  }else{
    NAME = true;
  }
  if ($('input[name=url]').val() == '') {
    URL = false;
  }else{
    URL = true;
  }
  if (NAME && URL) {
    return true;
  }else{
    return false;
  }
 });
</script>

<!--底部样式--> 
@endsection
@section('title','申请友情链接') 