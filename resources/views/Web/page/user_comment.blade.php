<div id="uid">
@foreach($comment as $row)
 <div style="overflow:hidden;margin-top:10px;height: 100px;width:100%;border:0px solid red;position:relative;">
   <div style="float:left;width: 100px; height: 100px; position: absolute; left: 30px;">
    <img src="{{$row->pic}}" alt="" style="width:80px; height: 80px;"><br/><span>&nbsp;&nbsp;{{$row->goods_name}}</span>
   </div>
   <div style="float: right;width:83%;border:1px solid #e0e0e0;height:98px">
    <span>{{$row->content}}</span>
   </div>
   <span style="position:absolute;bottom:5px;right:5px;">{{$row->addtime}}</span>
 </div>
@endforeach
</div>