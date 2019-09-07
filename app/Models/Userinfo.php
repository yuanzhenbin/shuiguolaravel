<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    //连接的表
    protected $table= "user_info";
    //主键
    protected $primarykey = "id";
    //自动维护时间戳  false 否 true 是
    public $timestamps = false;
    //可以被批量赋值属性)
    protected $fillable=['user_id','name','sex','pic','phone','email'];

    //修改器方法 对获取到的数据做处理 sex 状态字段 $value 需要处理的值
    // public function getSexAttribute($value){
    // 	//处理字段状态
    // 	$sex=[0=>'女',1=>'男',2=>'保密'];
    // 	//返回处理后的数据
    // 	return $sex[$value];
    // }
    public function getSexAttribute($value){
    	//处理字段状态
    	$sex=[0=>'女',1=>'男',2=>'保密'];
    	//返回处理后的数据
    	return $sex[$value];
    }

}
