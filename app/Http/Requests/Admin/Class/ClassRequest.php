<?php

namespace App\Http\Requests\Admin\Class;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Name' => ['required', 'string'],
            'class_image' => ['required', 'image'],// Use 'image' if you only want to check image type
            // If you want to check both presence and image type, use the following:
            //'image_path' => ['required', 'mimes:jpeg,png,jpg,gif'],
        ];
    }
}
