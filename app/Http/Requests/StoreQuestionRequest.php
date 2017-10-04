<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //开启认证
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
            'title' =>  'required|min:6|max:196',
            'content'   =>  'required|min:10'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '请输入标题！',
            'title.min' => '标题长度不得少于6个字符',
            'title.max' => '标题长度不得超过196个字符',
            'content.required' => '请输入内容！',
            'content.min' => '内容不得少于10个字符',
        ];
    }
}
