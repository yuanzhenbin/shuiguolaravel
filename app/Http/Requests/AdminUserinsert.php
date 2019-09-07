<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserinsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //用户名不能为空规则设置 required 输入的数据不能为空  regex 正则规则 unique唯一
            'username'=>'required|regex:/^.{1,8}$/|unique:user',
            //email 规则 校验数据是否符合邮箱格式
            // 'email'=>'required|email',
            //密码
            'password'=>'required|regex:/^\w{1,15}$/',
            //重复密码 same 校验两次密码是否一致
            'repassword'=>'required|regex:/^\w{1,15}$/|same:password',
        ];
    }

    public function messages(){
        return [
            'username.required'=>'用户名不能为空',
            'username.regex'=>'用户名必须为1-8个字符',
            'username.unique'=>'用户名重复',
            // 'email.required'=>'邮箱不能为空',
            // 'email.email'=>'邮箱不符合要求',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码必须为1-15位任意的数字字母下划线',
            'repassword.required'=>'重复密码不能为空',
            'repassword.regex'=>'重复密码必须为1-15位任意的数字字母下划线',
            'repassword.same'=>'两次密码不一致',
        ];
    }
}
