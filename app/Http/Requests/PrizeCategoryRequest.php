<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrizeCategoryRequest extends FormRequest
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
            'category_id' => 'required',
            'stock'  => 'required|integer|min:1',
            'point' => 'required|integer|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'categoria',
            'stock'  => 'unidades',
            'point' => 'puntos',
        ];
    }
}
