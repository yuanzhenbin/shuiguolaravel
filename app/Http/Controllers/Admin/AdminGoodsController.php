<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $k = $request->input('keywords');
        $goods = DB::table('goods')->where('goods_name','like','%'.$k.'%')->orderBy('type_id')->paginate(15);
        foreach ($goods as $key => $value) {
            $goods[$key]->type_name = DB::table("goods_type")->where("id","=",$value->type_id)->first()->type_name;
        }
        return view('Admin.Goods.index',['goods'=>$goods,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //连接数据库 查询有多少种商品分类
        $type = DB::table('goods_type')->select(DB::raw('*,concat(path,",",id)as paths'))->orderBy('paths')->get();
        foreach ($type as $key => $value) {
            //echo $value->path."<br>";
            $arr = explode(',',$value->path);
            $len = count($arr)-1;
            //echo $len.'<br>';
            $type[$key]->type_name=str_repeat('--|',$len).$value->type_name;
            //查询该类变是否有子分类 如果没有为0 可以选中
            $res = DB::table('goods_type')->where('pid','=',$value->id)->first();
            //var_dump(count($res));
            //将长度复制给 $type['test']
            $type[$key]->test = count($res);
            //非第三级分类不能添加商品
            $num = substr_count($value->path,",");
            if ($num !== 2) {
                $type[$key]->test = 1;
            }
        }//exit;
        //导入视图
        return view('Admin.goods.add',['type'=>$type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //去除传过来的 _token
        $data = $request->except('_token');
        //判断是否有传过来的图片
        if ($request->hasFile('pic')) {
            //图片名字初始化
            $name = time().rand(1,1000);
            //获取文件的后缀名
            $ext = $request->file('pic')->getClientOriginalExtension();
            //将文件移到指定目录下
            $request->file('pic')->move('./upload/goods/'.date("Y-m-d"),$name.'.'.$ext);
            //dd($request->all());
            //把上传的路径传到pic里面
            $data['pic']=trim('./upload/goods/'.date("Y-m-d")."/".$name.".".$ext,'.');
        }
        //dd($request->all());
        
        //将数据加入数据库中
        if(DB::table("goods")->insert($data)){
            return redirect("/admingoods")->with("success",'添加成功');
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
        //获取所有的商品类型 并按照顺序输出
        $type = DB::table('goods_type')->select(DB::raw('*,concat(path,",",id)as paths'))->orderBy('paths')->get();
        foreach ($type as $key => $value) {
             //echo $value->path."<br>";
            $arr = explode(',',$value->path);
            $len = count($arr)-1;
            //echo $len.'<br>';
            $type[$key]->type_name=str_repeat('--|',$len).$value->type_name;
            //查询该类变是否有自分类 如果没有为0 可以选中
            $res = DB::table('goods_type')->where('pid','=',$value->id)->first();
            //var_dump(count($res));
            //将长度复制给 $type['test']
            $type[$key]->test = count($res);
        }
        //获取该商品的数据信息
        $goods = DB::table('goods')->where('id','=',$id)->first();
        //dd($goods);
        //获取原商品的名字
        $g = DB::table('goods_type')->where('id','=',$goods->type_id)->first();
        $name = $g->type_name;
        return view('Admin.Goods.edit',['goods'=>$goods,'type'=>$type,'id'=>$id,'name'=>$name]);
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
        //dd($id);
        $data = $request->except('_token','_method');
        //dd($request->all());
        //判断是否有图片上传
        if ($request->hasFile('pic')) {
            //获取原先图片的路径
            $pic = DB::table('goods')->where('id','=',$id)->first();
            //删除原先图片的路径
            if ($pic->pic) {
                unlink('.'.$pic->pic);
            }
            //给新图片重新命名
            $name = time().rand(1,1000);
            //获取新图片的后缀名
            $ext = $request->file('pic')->getClientOriginalExtension();
            $data['pic'] = trim('./upload/goods/'.date("Y-m-d")."/".$name.".".$ext,'.');
            //将文件存放到新的目录
            $request->file('pic')->move('./upload/goods/'.date("Y-m-d"),$name.'.'.$ext);
        }
        //dd($data);
        $res = DB::table('goods')->where('id','=',$id)->update($data);
        if ($res) {
            return redirect('/admingoods')->with('success','修改成功');
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
        //
        //dd($id);
        //获取将要删除图片的路径
        $data = DB::table('goods')->where('id','=',$id)->first();
        $pic = $data->pic;
        //dd($pic);
        if (DB::table('goods')->where('id','=',$id)->delete()) {
            //$pic = $data->pic;
            //删除图片
            unlink('.'.$pic);
            //删除成功 返回商品列表页面
            return redirect('/admingoods')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
