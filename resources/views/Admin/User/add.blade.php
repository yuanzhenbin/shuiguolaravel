@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>会员添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminuser" method="post">
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
       <label class="mws-form-label">用户名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="username"/> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">密码</label> 
       <div class="mws-form-item"> 
        <input type="password" class="large" name="password" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">重复密码</label> 
       <div class="mws-form-item"> 
        <input type="password" class="large" name="repassword" /> 
       </div> 
      </div>   
     </div> 
     <div class="mws-button-row">
      {{csrf_field()}} 
      <input type="submit" value="添加" class="btn btn-success" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','会员添加')