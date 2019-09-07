@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>会员修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/admin/{{$user->id}}" method="post">
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
        <input type="text" class="large" name="admin_name" value="{{$user->admin_name}}" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">旧密码</label> 
       <div class="mws-form-item"> 
        <input type="password" class="large" name="oldpassword" value=""/> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">新密码</label> 
       <div class="mws-form-item"> 
        <input type="password" class="large" name="password" value=""/> 
       </div> 
      </div>     
     </div> 
     <div class="mws-button-row">
      {{csrf_field()}}
      {{method_field("PUT")}} 
      <input type="submit" value="提交" class="btn btn-danger" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','用户修改')