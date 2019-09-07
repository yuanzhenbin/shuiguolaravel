<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/static/admin/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/admin/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/static/admin/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/static/admin/css/login.css" media="screen">

<link rel="stylesheet" type="text/css" href="/static/admin/css/mws-theme.css" media="screen">

<title>后台登录</title>

</head>

<body>

    <div id="mws-login-wrapper" style="background: #7a8b8b">
        <div id="mws-login">
            <h1>后台登录</h1>
            <div id="mws-login-form">            
                @if(session('error'))    
                <div class="warning" style="color: #ee7621;">
                    {{session('error')}}
                </div>
                @endif
                <form class="mws-form" action="/admindologin" method="post">
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <input type="text" name="admin_name" class="mws-login-username required" placeholder="用户名">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <input type="password" name="password" class="mws-login-password required" placeholder="密码">
                        </div>
                    </div>
                    {{csrf_field()}}
                    <div class="mws-form-row">
                        <input type="submit" value="登录" class="btn btn-success mws-login-button">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Plugins -->
    <script src="/static/admin/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/static/admin/js/libs/jquery.placeholder.min.js"></script>
    <script src="/static/admin/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/static/admin/jui/js/jquery-ui-effects.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="/static/admin/plugins/validate/jquery.validate-min.js"></script>

    <!-- Login Script -->
    <script src="/static/admin/js/core/login.js"></script>

</body>
</html>
