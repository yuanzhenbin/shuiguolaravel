<?php

namespace App\Http\Middleware;

use Closure;

class UserLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //中间件过滤数据的核心，操作方法  $request请求报文   Closure $next 下一个请求
    public function handle($request, Closure $next)
    {
        //检测当前有没有登录的session信息
        if ($request->session()->has('user_name')) {
            //获取访问模块控制器和方法名
            return $next($request);
        }else{
            //跳转到登录界面 ndoejs也是用redirect跳转
            return redirect("/login");
        }
    }
}
