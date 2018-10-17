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
            "name" => "required|min:2",
            "description" => "required|min:2|max:255",
            "user_id" => "required",
            "category_id" => "required"
        ];
    }

    public function messages()
    {
        return [
            "description.required" => "Campo description é obrigatório",
            "user_id.required" => "Campo user_id é obrigatório",
            "category_id.required" => "Campo category_id é obrigatório",
            "name.required" => "Campo name é obrigatório",
            "name.min" => "Campo name deve ter pelo menos 3 dígitos",
            "name.max" => "Campo name deve ter no máximo 255 dígitos",
        ];
    }
}
