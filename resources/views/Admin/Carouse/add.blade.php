@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
  <script src="/static/admins/js/libs/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>轮播图添加</span> 
   </div> 
   <form action="/admincarouses" method="post" enctype="multipart/form-data" onsubmit="return check()">
	<div>
		图片添加
		<input type="file" name="pic" onClick="t_file.click()" id="f_file" >
	</div>
	<div>
	{{csrf_field()}}
	<button type="submit" class="btn btn-info">提交</button>
	</div>
	</form>
  </div>
 </body>
<script>
function check(){
var str = document.getElementById("f_file").value;
if(str.length==0)
{
alert("请选择上传");
return false;
}
return true;
}
 </script>
</html>
@endsection
@section('title','轮播图添加')