@extends("AdminPublic.public")
@section('admin')
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<style>
html {
	height:100%;
	opacity:0.8;
}
.wrapper {
	margin-top:200px;
	perspective:1000px;
}
.cube {
	height:200px;
	width:200px;
	position:relative;
	margin:auto;
	transform-style:preserve-3d;
	-webkit-animation:rotate 15s infinite;
	-o-animation:rotate 15s infinite;
	animation:rotate 15s infinite 2s;
}
@keyframes rotate {
	from {
	transform:rotateY(0deg) rotateX(0deg);
}
to {
	transform:rotateY(360deg) rotateX(360deg);
}
}.cube>div {
	height:100%;
	width:100%;
	opacity:0.9;
	position:absolute;
	text-align:center;
	background:#333;
	color:#fff;
	line-height:200px;
	font-size:30px;
}
.plane-front {
	transform:translateZ(100px);
}
.plane-back {
	transform:rotateY(180deg) translateZ(100px);
}
.plane-left {
	transform:rotateY(270deg) translateZ(100px);
}
.plane-right {
	transform:rotateY(90deg) translateZ(100px);
}
.plane-top {
	transform:rotateX(90deg) translateZ(100px);
}
.plane-bottom {
	transform:rotateX(270deg) translateZ(100px);
}
.cube:hover .plane-front {
	transform:translateZ(200px);
}
.cube:hover .plane-back {
	transform:rotateY(180deg) translateZ(200px);
}
.cube:hover .plane-left {
	transform:rotateY(270deg) translateZ(200px);
}
.cube:hover .plane-right {
	transform:rotateY(90deg) translateZ(200px);
}
.cube:hover .plane-top {
	transform:rotateX(90deg) translateZ(200px);
}
.cube:hover .plane-bottom {
	transform:rotateX(270deg) translateZ(200px);
}
.plane-front>img{
	height:200px;
	width:200px;
}
.plane-back>img{
	height:200px;
	width:200px;
}
.plane-right>img{
	height:200px;
	width:200px;
}
.plane-left>img{
	height:200px;
	width:200px;
}
.plane-top>img{
	height:200px;
	width:200px;
}
.plane-bottom>img{
	height:200px;
	width:200px;
}
</style>
</head>
<body>
<div class="wrapper">
    <div class="cube">
        <div class="plane-front">{{session("admin_name")}}</div>
        <div class="plane-back">{{session("admin_name")}}</div>
        <div class="plane-right" style="background: yellow;">进入后台</div>
        <div class="plane-left" style="background: yellow;">欢迎</div>
        <div class="plane-top" style="background: skyblue;">欢迎</div>
        <div class="plane-bottom" style="background: skyblue;">进入后台</div>
    </div>
</div>

</body>
</html>

<!-- <html lang="en">
<head></head>
<body>
	<center>
	<div style="width: 70%; height: 500px; margin-top: 100px; background: #f5f5f5">
		<b style="text-align: center; font-size: 30px; line-height: 500px;">欢迎{{session("admin_name")}}进入后台管理系统</b>
	</div>
	</center>
</body>
</html> -->
@endsection
@section('title','后台首页')