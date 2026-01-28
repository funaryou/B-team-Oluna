<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;    // 現在は誰でもOK（後で認証を追加する場合はここを変更）
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'     => 'required|string|max:255',
            'tags'      => 'nullable|array',
            'tags.*'    => 'string|max:50',
            'text'      => 'required|string|min:10',
            'thumbnail' => 'required|image|max:2048',
            'images'    => 'nullable|array|max:5', // 最大５枚まで（仮）
            'images.*'  => 'image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'タイトルは必須です',
            'title.max' => 'タイトルは255文字以内で入力してください',
            'text.required' => '本文は必須です',
            'text.min' => '本文は10文字以上で入力してください',
            'thumbnail.required' => 'サムネイル画像は必須です',
            'thumbnail.image' => 'サムネイルは画像ファイルを選択してください',
            'images.max' => '画像は最大5枚までです',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'タイトル',
            'text' => '本文',
            'thumbnail' => 'サムネイル画像',
            'images' => '記事内画像',
            'tags' => 'タグ',
        ];
    }
}
