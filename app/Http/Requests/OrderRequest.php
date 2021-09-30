<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            "order_date" => "required|date",
            "order_number" => "required|integer",
            "customer_id" => "required|exists:customers,id",

            "items.*.product_id" => "required|exists:products,id",
            "items.*.quantity" => "required|integer",
        ];
    }
}
