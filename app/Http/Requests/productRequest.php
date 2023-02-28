<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //ルール
            'product_name' => 'required',
            'price' => 'required | alpha_num',
            'stock' => 'required | alpha_num',
            'comment' => 'required | max:10000',
            'img_path' => 'required | image',
        ];
    }

    //項目
    public function attributes() {
        return [
            'product_name' => '商品名',
            'price' => '価格',
            'stock' => '在庫',
            'comment' => 'コメント',
            'img_path' => '画像',
        ];
    }

    //表示メッセージ
    public function message() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'price.alpha_num' => ':attributeは半角数字で入力してください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.alpha_num' => ':attributeは半角数字で入力してください。',
            'comment.max' => ':attributeはmax字以内で入力してください。',
            'comment.required' => ':attributeは必須項目です。',
            'img_path.required' => ':attributeは必須項目です。',
            'img_path.image' => '指定されたファイルが画像ではありません。',
        ];
    }
}
