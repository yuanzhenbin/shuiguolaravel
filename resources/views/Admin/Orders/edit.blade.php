@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>订单状态修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminorders/{{$data->id}}" method="post" enctype="multipart/form-data">
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
       <label class="mws-form-label">订单号</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" value="{{$data->code}}" disabled="disabled" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">收货人</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" value="{{$data->user_name}}" disabled="disabled" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">发货状态</label> 
       <div class="mws-form-item"> 
         <select name="fahuo" class="large">
           <option value="0" @if($data->fahuo == 0) selected @endif >等待发货</option>
           <option value="1" @if($data->fahuo == 1) selected @endif >已发货</option>
         </select> 
       </div> 
      </div>    
     </div> 
     <div class="mws-button-row">
      {{csrf_field()}}
      {{method_field('put')}}
      <input type="submit" value="提交" class="btn btn-success" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','订单状态修改')