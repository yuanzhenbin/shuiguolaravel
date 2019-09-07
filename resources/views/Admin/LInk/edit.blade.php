@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <script src="/static/admins/js/libs/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>友情修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminlinks/{{$link->id}}" method="post">    
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">名字</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="connection_name"  value="{{$link->connection_name}}"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">URL</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="url" value="{{$link->url}}"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">审核状态</label> 
       <div class="mws-form-item"> 
         <select name="status" style="width: 10%;">
           <option value="0" @if($link->status==0) selected="selected" @endif>待审核</option>
           <option value="1" @if($link->status==1) selected="selected" @endif>审核通过</option>
         </select>
       </div> 
      </div>
     </div> 
     <div class="mws-button-row">
      {{csrf_field()}} 
      {{method_field("PUT")}}
      <input type="submit" value="修改"class="btn btn-success" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
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
</html>
@endsection
@section('title','友情修改')