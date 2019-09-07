<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Orderinsert extends FormRequest
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
            'total'=>'required',
            'address'=>'required',
            'zhifu'=>'required',
        ];
    }

    public function messages(){
        return [
            'total.required'=>'您还没有要购买的商品',
            'address.required'=>'您还没有选择收货地址',
            'zhifu.required'=>'您还没有选择支付方式',
        ];
    }
}
