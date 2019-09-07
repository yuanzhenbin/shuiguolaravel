@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <script src="/static/admins/js/libs/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>友情添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminlinks" method="post">    
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">名字</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="connection_name"  /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">URL</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="url" /> 
       </div> 
      </div> 

     </div> 
     <div class="mws-button-row">
      {{csrf_field()}} 
      <input type="submit" value="添加"class="btn btn-success" /> 
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
@section('title','友情添加')