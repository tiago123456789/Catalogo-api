<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
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
            "active" => "required",
            "value" => "required",
            "price_promotional" => "required",
            "product_id" => "required"
        ];
    }


    public function messages()
    {
        return [
            "active.required" => "Campo active é obrigatório.",
            "value.required" => "Campo value é obrigatório.",
            "price_promotional.required" => "Campo price_promotional é obrigatório.",
            "product_id.required" => "Campo product_id é obrigatório."
        ];
    }
}
