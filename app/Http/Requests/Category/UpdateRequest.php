<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'=> 'required|string|unique:categories,name,'.$this->route('category')->id.' |max:255',
            'description'=> 'nullable|string|max:250',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Este campo es requerido',
            'name.string' => 'El valor no es correcto',
            'name.max' => 'Solo se permiten 50 caracteres',

            'description.string' => 'El valor no es correcto',
            'description.max' => 'Solo se permiten 250 caracteres',

        ];
    }
}
