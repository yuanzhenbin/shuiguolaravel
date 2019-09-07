@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>权限添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/role" method="post">
    @if (count($errors) > 0)
      <div class="mws-form-message error">
      <div class="alert alert-danger">
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
      </div>
    @endif 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">节点名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="node_name" value="" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">控制器名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="cname" value=""/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">方法名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="fname" value=""/> 
       </div> 
      </div>   
     </div> 
     <div class="mws-button-row">
      {{csrf_field()}} 
      <input type="submit" value="提交" class="btn btn-success" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','权限添加')