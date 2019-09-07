@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>会员状态修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminuser/{{$id}}" method="post">
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
       <label class="mws-form-label">会员名称</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" style="width: 10%;" name="username" value="{{$username}}" disabled="disabled" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">会员状态</label> 
       <div class="mws-form-item"> 
         <select name="status" style="width: 10%;">
           <option value="1" @if($status=='正常状态') selected="selected" @endif>正常状态</option>
           <option value="0" @if($status=='封禁状态') selected="selected" @endif>封禁状态</option>
         </select>
       </div> 
      </div>   
     </div> 
     <div class="mws-button-row">
      {{csrf_field()}}
      {{method_field("PUT")}} 
      <input type="submit" value="修改" class="btn btn-success" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','会员状态修改')