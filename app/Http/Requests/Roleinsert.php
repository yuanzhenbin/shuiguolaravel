<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Roleinsert extends FormRequest
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
            'node_name'=>'required',
            'cname'=>'required|regex:/\w/',
            'fname'=>'required|regex:/\w/'
        ];
    }

    public function messages(){
        return [
            'node_name.required'=>'节点名不能为空',
            'cname.required'=>'控制器名不能为空',
            'cname.regex'=>'控制器名必须为数字字母下划线',
            'fname.required'=>'方法名不能为空',
            'fname.regex'=>'方法名必须为数字字母下划线',
        ];
    }
}
