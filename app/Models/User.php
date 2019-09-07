<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //连接的表
    protected $table= "user";
    //主键
    protected $primarykey = "id";
    //自动维护时间戳  false 否 true 是
    public $timestamps = true;
    //可以被批量赋值属性)
    protected $fillable=['username','password','status','token','email','phone'];

    //修改器方法 对获取到的数据做处理 sex 状态字段 $value 需要处理的值
    // public function getSexAttribute($value){
    // 	//处理字段状态
    // 	$sex=[0=>'女',1=>'男',2=>'保密'];
    // 	//返回处理后的数据
    // 	return $sex[$value];
    // }
    public function getStatusAttribute($value){
    	//处理字段状态
    	$status=[1=>'正常状态',0=>'封禁状态'];
    	//返回处理后的数据
    	return $status[$value];
    }

    //会员模型和详情模型关联
    public function info(){
        // hasOne 一对一  App\Models\Userinfo会员模型详情类  users_id两模型关联字段
        return $this->hasOne('App\Models\Userinfo','user_id');
    }
}
