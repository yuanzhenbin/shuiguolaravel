<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Passwordinsert extends FormRequest
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
            //密码
            'password'=>'required|regex:/^\w{1,15}$/',
            //重复密码 same 校验两次密码是否一致
            'repassword'=>'required|regex:/^\w{1,15}$/|same:password',
        ];
    }

    public function messages(){
        return [
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码必须为1-15位任意的数字字母下划线',
            'repassword.required'=>'重复密码不能为空',
            'repassword.regex'=>'重复密码必须为1-15位任意的数字字母下划线',
            'repassword.same'=>'两次密码不一致',
        ];
    }
}
