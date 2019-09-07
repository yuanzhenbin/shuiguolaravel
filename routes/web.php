<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//测试页面
// Route::get("/send","web\RegisterController@sendMail");

//----------------------------------------------------------------
//前台路由
//设置/和/index都跳转首页     前台首页
Route::get("/","Web\WebIndexController@index");
Route::get("/index","Web\WebIndexController@index");

//前台登录 带控制器写法
Route::get("/login","Web\WebController@login");
//前台执行登录
Route::resource("/dologin","Web\WebLoginController");
//前台注册
Route::resource("/registered","Web\RegisterController");
//注册所需验证码
Route::get('/code',"Web\RegisterController@code");
//激活
Route::get('/activtion',"Web\RegisterController@activtion");
// 忘记密码
Route::resource("/forget","Web\ForgetController");
//重置密码
Route::get("/reset","Web\ForgetController@reset");
//执行重置密码
Route::post("/doreset","Web\ForgetController@doreset");
//注册二 调用短信接口
Route::resource("/homeregisters","Web\RegistersController");
Route::get("/checkphone","Web\RegistersController@checkphone");
Route::get("/sendphone","Web\RegistersController@sendphone");
Route::get("/checkcode","Web\RegistersController@checkcode");


//所有果蔬页
Route::get("/Products","Web\WebController@Products");
//活动专区（积分商城）
Route::get("/integral","Web\WebController@integral");
//商品一级列表
Route::get("/Products_list/{id}","Web\WebController@Products_list");
//商品二级列表
Route::get("/Products_lists/{id}","Web\WebController@Products_lists");
//商品详情
Route::get("/Product_detailed/{id}","Web\WebController@Product_detailed");
//申请友情链接
Route::resource("/weblink","Web\WebLinkController");

//搜索
Route::get('/search','Web\WebController@search');

//中间件判断是否登录
Route::group(["middleware"=>"userlogin"],function(){
	//收藏商品
	Route::get("/collection/{id}","Web\WebController@collection");
	//我的收藏
	Route::get("/user_Collect","Web\WebController@user_collection");
	//删除收藏
	Route::get("/del_collection/{id}","Web\WebController@del_collection");
	//个人中心
	Route::get("/user","Web\WebController@user");
	//个人资料
	Route::get("/user_info","Web\WebController@user_info");
	//修改密码
	Route::get("/user_Password","Web\WebController@user_Password");
	//历史订单
	Route::get("/user_Orders","Web\WebController@user_Orders");
	//我的积分
	Route::get("/user_integral","Web\WebController@user_integral");
	//前端用户修改个人信息
	Route::resource("/webuserinfo","Web\WebUserController");
	//前端用户修改密码
	Route::resource("/webpassword","Web\WebPasswordController");
	//用户收货地址
	Route::resource("/user_address","Web\WebAddressController");
	Route::get("/address","Web\WebAddressController@address");
	Route::post("/saveaddress","Web\WebAddressController@saveaddress");
	//在订单页的删除地址
	Route::get("/deladdress/{id}","Web\WebAddressController@deladdress");
	Route::get("/deladd/{id}","Web\WebAddressController@deladd");
	//购物车
	Route::resource("/shopping_cart","Web\ShopCartController");
	//购物数量加减
	Route::get("/jian/{id}","Web\ShopCartController@jian");
	Route::get("/jia/{id}","Web\ShopCartController@jia");
	//确认订单
	Route::resource("/Orders","Web\WebOrderController");
	// //支付宝接口调用
	// Route::resource("/pay","Web\PayController@pay");
	// //通知给客户端的界面
	Route::get("/payreturn","Web\WebOrderController@payreturn");
	//积分订单
	Route::resource("/jifenorders","Web\JifenOrdersController");

	//我的评论
	Route::get("/user_pinglun","Web\WebController@user_pinglun");
	//添加评论
	Route::post("/comment",'Web\WebController@comment');
	//保存评论
	Route::post("/comments",'Web\WebController@comments');
});

//-----------------------------------------------------------------
//后台路由
//跳转登录页面
Route::resource("/admindologin","Admin\AdminLoginController");
Route::get("/adminlogin",function(){
	return view("admin.login");
});

//中间件判断是否登录
Route::group(["middleware"=>"adminlogin"],function(){
	//后台首页
	Route::get("/adminindex","Admin\AdminController@adminindex");
	//管理员 资源控制器
	Route::resource("/admin","Admin\AdminController");
	Route::get("/admin/role/{id}","Admin\AdminController@role");
	Route::post("/dorole","Admin\AdminController@dorole");

	//角色管理
	Route::resource("/role","Admin\RoleController");

	//会员
	Route::resource("/adminuser","Admin\UserController");
	//会员详细信息
	Route::resource("/userinfo","Admin\UserInfoController");
	//会员收藏
	Route::get("/userinfo/collection/{id}","Admin\UserInfoController@collection");
	//会员收货地址
	Route::get("/userinfo/address/{id}","Admin\UserInfoController@address");

	//商品分类
	Route::resource("/admintype","Admin\AdminTypeController");
	//商品
	Route::resource("/admingoods","Admin\AdminGoodsController");
	//积分商品
	Route::resource("/adminjifen","Admin\AdminJifenController");

	//订单
	Route::resource("/adminorders","Admin\AdminOrdersController");
	//积分订单
	Route::resource("/jifenorder","Admin\JifenOrderController");//jifenorders是前端路由
	//商品评论
	Route::resource("/adminmessage","Admin\MessageController");

	//友情链接
	Route::resource("/adminlinks","Admin\LinkController");
	//轮播图
	Route::resource("/admincarouses","Admin\CarouseController");
});



