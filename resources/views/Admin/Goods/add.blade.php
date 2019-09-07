@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>商品添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/admingoods" method="post" enctype="multipart/form-data">
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
       <label class="mws-form-label">商品名称</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="goods_name" value="" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">商品类型</label> 
       <div class="mws-form-item"> 
        <select name="type_id" class="large">
           <option value="">--请选择--</option>
           @foreach($type as $row)
           @if($row->test)
           <option disabled="disabled" value="{{$row->id}}" style="background: #f1f1f1;">{{$row->type_name}}</option>
           @else
           <option value="{{$row->id}}">{{$row->type_name}}</option>
           @endif
           @endforeach
         </select> 
       </div> 
      </div> 

       <div class="mws-form-row"> 
       <label class="mws-form-label">价格</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="price" value=""/> 
       </div>
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">总数</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="total" value=""/>
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">销售</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="sales" value=""/>
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">图片</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large" name="pic" value=""/>
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">描述</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="describe" value=""/> 
       </div> 
      </div>    
     </div> 
     <div class="mws-form-row"> 
       <label class="mws-form-label">隐藏类</label> 
       <div class="mws-form-item"> 
         <select name="lei" class="large">
           <option value="1">水果</option>
           <option value="2">蔬菜</option>
           <option value="3">干果</option>
         </select> 
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
@section('title','商品添加')