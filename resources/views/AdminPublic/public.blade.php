<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/static/admin/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/admin/custom-plugins/wizard/wizard.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/static/admin/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/admin/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/admin/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/static/admin/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/admin/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/admin/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/static/admin/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/static/admin/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/admin/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/static/admin/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/admin/css/themer.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/admin/css/my.css" media="screen">
<style>
    #my_a{font-size: 18px; line-height: 30px; color: skyblue;}
</style>


<title>@yield('title')</title>

</head>

<body>
	<!-- Header -->
	<div id="mws-header" class="clearfix">
    
    	<!-- Logo Container -->
    	<div id="mws-logo-container">
        
        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<div id="mws-logo-wrap">
                <p style="color: #fff; font-size: 20px; margin-top: 15px;">易田商城管理系统</p>
			</div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
            
            <!-- Messages -->
            <div id="mws-user-message" class="mws-dropdown-menu">
            	<i class="icol32-user"></i>
            </div>
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset" style="font-size: 18px; color: #fff; line-height: 30px;">       
                &nbsp;<span>{{session("role_name")}}</span>&nbsp;&nbsp;<span style="color: skyblue">{{session("admin_name")}}</span>&nbsp;
            </div>

            <div id="mws-user-message" class="mws-dropdown-menu">
                <a href="/admindologin" title="" id="my_a">退出</a>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
    	<!-- Necessary markup, do not remove -->
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
        	<!-- Searchbox -->
        	<div id="mws-searchbox" class="mws-inset">
            	<form action="typography.html">
                	<input type="text" class="mws-search-input">
                    <button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
                </form>
            </div>
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                    <li>
                        <a href="#"><i class="icon-official"></i> 用户管理</a>
                        <ul class="closed">
                            <li><a href="/admin">用户列表</a></li>
                            <li><a href="/admin/create">用户添加</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-key"></i> 角色管理</a>
                        <ul class="closed">
                            <li><a href="/role">角色列表</a></li>
                            <li><a href="/role/create">添加权限</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-user"></i> 会员管理</a>
                        <ul class="closed">
                            <li><a href="/adminuser">会员列表</a></li>
                            <li><a href="/adminuser/create">会员添加</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-business-card"></i> 会员详情</a>
                        <ul class="closed">
                            <li><a href="/userinfo">会员详细信息</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-th-list"></i> 分类管理</a>
                        <ul class="closed">
                            <li><a href="/admintype">分类列表</a></li>
                            <li><a href="/admintype/create">分类添加</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-shopping-cart"></i> 商品管理</a>
                        <ul class="closed">
                            <li><a href="/admingoods">商品列表</a></li>
                            <li><a href="/admingoods/create">商品添加</a></li> 
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-list-2"></i> 订单管理</a>
                        <ul class="closed">
                            <li><a href="/adminorders">订单列表</a></li>
                            <li><a href="/jifenorder">积分订单列表</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-pencil"></i> 评论管理</a>
                        <ul class="closed">
                            <li><a href="/adminmessage">评论列表</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-pacman"></i> 积分商品管理</a>
                        <ul class="closed">
                            <li><a href="/adminjifen">积分商品列表</a></li>
                            <li><a href="/adminjifen/create">积分商品添加</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-link"></i> 友情链接管理</a>
                        <ul class="closed">
                            <li><a href="/adminlinks">链接列表</a></li>
                            <li><a href="/adminlinks/create">链接添加</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-pictures"></i> 轮播图管理</a>
                        <ul class="closed">
                            <li><a href="/admincarouses">轮播图列表</a></li>
                            <li><a href="/admincarouses/create">轮播图添加</a></li>
                        </ul>
                    </li>
                </ul>
            </div>         
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix" style="background: #fff">
        
            	<div class="container">
                    @if(session('success'))
                    <div class="mws-form-message success">
                       {{session('success')}}
                    </div>
                    @endif
                    
                    @if(session('error'))    
                    <div class="mws-form-message warning">
                        {{session('error')}}
                    </div>
                    @endif
                                           
                    @section('admin')
                    @show
                               
                    <!-- Panels End -->
                </div>
                <!-- footer -->
                <div id="mws-footer">
                    Copyright Your Website 2012. All Rights Reserved.
                </div>
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    <script src="/static/admin/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/static/admin/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/static/admin/js/libs/jquery.placeholder.min.js"></script>
    <script src="/static/admin/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/static/admin/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/static/admin/jui/jquery-ui.custom.min.js"></script>
    <script src="/static/admin/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/static/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <!--[if lt IE 9]>
    <script src="js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="/static/admin/plugins/flot/jquery.flot.min.js"></script>
    <script src="/static/admin/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
    <script src="/static/admin/plugins/flot/plugins/jquery.flot.pie.min.js"></script>
    <script src="/static/admin/plugins/flot/plugins/jquery.flot.stack.min.js"></script>
    <script src="/static/admin/plugins/flot/plugins/jquery.flot.resize.min.js"></script>
    <script src="/static/admin/plugins/colorpicker/colorpicker-min.js"></script>
    <script src="/static/admin/plugins/validate/jquery.validate-min.js"></script>
    <script src="/static/admin/custom-plugins/wizard/wizard.min.js"></script>

    <!-- Core Script -->
    <script src="/static/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/admin/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/static/admin/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/static/admin/js/demo/demo.dashboard.js"></script>

</body>
</html>