<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Registerinsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // 表单授权
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // 校验规则
    public function rules()
    {
        return [
            // 用户名不能为空规则设置 required 输入的数据不能为空 regax 正则
            'username'=>'required|regex:/^.{1,8}$/|unique:user',
            //email规则检测是否符合邮箱规则
            'email'=>'required|email|unique:user',
            'password'=>'required|regex:/^\w{4,16}$/',
            'repassword'=>'required|regex:/^\w{4,16}$/|same:password'
        ];
    }
    // 自定义作物xinxi
    public function messages(){
        return [
            'username.required'=>'用户名不能为空',
            'username.regex'=>'用户名必须是1-8个字符',
            'username.unique'=>'用户名已存在',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'请填写邮箱正确格式',
            'email.unique'=>'邮箱已被注册',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码必须是4-16位',
            'repassword.required'=>'重复密码不能为空',
            'repassword.regex'=>'重复密码必须是4-16位',
            'repassword.same'=>'两次密码不一致',
        ];
    }
}
