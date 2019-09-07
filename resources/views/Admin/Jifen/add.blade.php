@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>类别添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminjifen" method="post">
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
       <label class="mws-form-label">积分商品</label> 
       <div class="mws-form-item"> 
        <!-- <input type="text" class="large" name="age"/> --> 
        <select name="jifen_name" id="" class="large">
            @foreach($result as $row)
            <option value="{{$row->goods_name}}">{{$row->goods_name}}</option>
            @endforeach
        </select>
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">积分价格</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="jifen_price"/> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">商品描述</label> 
       <div class="mws-form-item"> 
        <textarea name="describe" rows="5" cols="50"></textarea>
       </div> 
      </div>
     </div> 
     <div class="mws-button-row">
      {{csrf_field()}}
      <input type="submit" value="提交" class="btn btn-danger" /> 
      <input type="reset" value="重置" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','类别添加')