<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'         => 'required',
            'description'  => 'required|string|max:255',
            'image'        => 'required|mimes:png,jpeg',
            'category'     =>'required',
            'condition_id' => 'required',
            'price'        => 'required|integer|min:0',
        ];
    }
    public function messages()
    {
        return [
            'name.required'         => '商品名を入力してください',
            'description.required'  => '商品説明を入力してください',
            'description.max'       => '255文字以内で入力してください',
            'price.required'        => '値段を入力してください',
            'price.integer'         => '数値で入力してください',
            'price.min:0'           => '0円以上で入力してください',
            'image.required'        => '画像を登録してください',
            'image.mimes:png,jpeg'  => '「.png」または「.jpeg」形式でアップロードしてください',
            'condition_id.required' => '商品の状態を選択してください',
            'category.required'     => 'カテゴリーを選択してください',

        ];
    }
}
