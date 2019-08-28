<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePrizeRequest extends FormRequest
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
            'name' => 'required',
            'point' => 'required|integer|min:1',
            'code' => 'required|unique:prizes',
            // 'image' => 'required',
            'stock'  => 'required|integer|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'point' => 'puntos',
            'code' => 'codigo',
            // 'image' => 'required',
            'stock'  => 'unidades',
        ];
    }
}
