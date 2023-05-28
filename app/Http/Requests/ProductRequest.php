<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required | max:255 ',
            'price' => 'required | max:255 |integer',
            'stock'=> 'required | max:255|integer',
            'comment' => 'max:10000',
        ];
    }


    /**
    * 項目名
     *
     * @return array
    */
    public function attributes()
    {
        return [

            'product_name' => '製品名',
            'company_id' => '商品id',
            'price' => '価格',
            'stock' => '在庫',
            'comment' => 'コメント',
            'img_path' => '画像',

        ];
    }

    /**
     * エラーメッセージ
    *
    * @return array
    */
    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'product_name.max' => ':attributeは:max字以内で入力してください。',
            
            'price.required' => ':attributeは必須項目です。',
            'price.max' => ':attributeは:max字以内で入力してください。',
            'price.integer' => ':attributeは数字で入力してください。',

            'stock.required' => ':attributeは必須項目です。',
            'stock.max' => ':attributeは:max字以内で入力してください。',
            'stock.integer' => ':attributeは数字で入力してください。',

            'comment.max' => ':attributeは:max字以内で入力してください。',
    ];
}



}

