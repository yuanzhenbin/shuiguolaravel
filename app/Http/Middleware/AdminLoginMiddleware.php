<?php

namespace App\Http\Middleware;

use Closure;

class AdminLoginMiddleware
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
        if ($request->session()->has('admin_name')) {
            //获取访问模块控制器和方法名
            $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
            $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            $func=explode('@', $actions[count($actions)-1]);
            //控制器名字
            $controllerName=$func[0];
            //方法
            $actionName=$func[1];
            $nodelist = session("nodelist");
            if (empty($nodelist[$controllerName]) || !in_array($actionName,$nodelist[$controllerName])) {
                return redirect("/adminindex")->with('error','非常抱歉,你的权限不足');
            }
            return $next($request);
        }else{
            //跳转到登录界面 ndoejs也是用redirect跳转
            return redirect("/adminlogin");
        }
    }
}
