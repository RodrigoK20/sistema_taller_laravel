<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\MessageBag;



class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    protected $redirectRoute = 'categories.create';
    
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
            'name'=> 'required|string|max:50|unique:categories',
            'description'=> 'nullable|string|max:250',
        ];
    }
    

    public function messages(){
        return [
            'name.required' => 'Este campo es requerido',
            'name.string' => 'El valor no es correcto',
            'name.max' => 'Solo se permiten 50 caracteres',
            'name.unique'=> 'La categoria ya se encuentra registrada',

            'description.string' => 'El valor no es correcto',
            'description.max' => 'Solo se permiten 250 caracteres'

        ];

      
        
       
    }
}
