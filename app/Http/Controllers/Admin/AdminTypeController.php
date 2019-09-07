<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\AdminUserinsert;
use App\Models\User;

class AdminTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //查询父ID为0的商品分类
        $k = $request->input('keywords');
        $result = DB::table('goods_type')->select(DB::raw('*,concat(path,",",id)as paths'))->orderBy('paths')->where('type_name','like','%'.$k.'%')->paginate(15);
        foreach ($result as $key => $value) {
            $arr = explode(',',$value->path);
            $len = count($arr)-1;
            $result[$key]->type_name = str_repeat('--|',$len).$value->type_name;
        }
        //显示商品的顶级分类
        return view("Admin.Type.index",["result"=>$result,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $result = DB::table('goods_type')->select(DB::raw('*,concat(path,",",id)as paths'))->orderBy('paths')->get();
        foreach ($result as $key => $value) {
            $arr = explode(',',$value->path);
            $len = count($arr)-1;
            $result[$key]->type_name = str_repeat('--|',$len).$value->type_name;
        }
        //dd($result);
        return view('Admin.Type.add',['result'=>$result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
        $type_name = $request->input('type_name');
        $pid = $request->input('pid');
        if ($pid == 0) {//是否顶级分类
            $result = DB::table('goods_type')->insert(["type_name"=>$type_name,"pid"=>$pid,"path"=>0]);
            if ($result > 0) {
                return redirect('/admintype')->with("success","添加成功");
            }else{
                return back()->with("error","添加失败");
            }     
        }else{
            //dd($pid);
            $data = DB::table('goods_type')->where('id','=',$pid)->first();
            //dd($data);
            $path = $data->path.','.$data->id;
            //dd($path);
            $pid = $data->id;
            $result = DB::table('goods_type')->insert(["type_name"=>$type_name,"pid"=>$pid,"path"=>$path]);
            if ($result > 0) {
                return redirect('/admintype')->with("success","添加成功");
            }else{
                return back()->with("error","添加失败");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //根据id 查询该数据
        $data = DB::table('goods_type')->where('id','=',$id)->first();
        //导入模板 输出值
        return view('Admin.Type.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //echo $id;
        //dd($request->input('name'));
        //获取传过来的name值
        $name = $request->input('name');
        //通过id值进行修改
        $result = DB::table('goods_type')->where('id','=',$id)->update(['type_name'=>$name]);
        //var_dump($result);
        //返回 商品分类列表
        if ($result > 0) {
            return redirect('/admintype')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //查询数据库中是否有该商品分类的子分类 如果有则不能删除 如果没有则删除
        $pid = DB::table("goods_type")->where('pid','=',$id)->get();
        //判断返回值是否为空，如果为空则删除该商品分类
        // echo count($pid);
        if (count($pid)) {
            //echo 1;
            //该商品分类存在子分类，不能删除
            return back()->with('error','存在子分类，不能删除');
        }else{
            $goods = DB::table("goods")->where("type_id","=",$id)->get();
            if(count($goods)){
                //改商品分类存在商品，不能删除
                return back()->with('error','该类下有商品，不能删除');
            }else{
                //echo 2;
                //删除该商品分类
                $row = DB::table('goods_type')->where('id','=',$id)->delete();
                return redirect('/admintype')->with('success','删除成功');
            }
        }
    }
}
