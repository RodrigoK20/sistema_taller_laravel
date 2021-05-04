<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            
                //'name'=> 'required|string|max:255|unique:products',
                'name'=> 'required|string|max:255',
                'image'=> 'nullable|dimensions:min_width=500,min_height=500',
                'description'=> 'nullable|string|max:250',
                'code'=> 'nullable|min:8|max:8|unique:products',
                'sell_price'=> 'required|',
                'category_id'=> 'required|integer',
                'provider_id'=> 'required|integer',
                
            ];
    

    }

    public function messages(){
        return [

            'name.required' => 'Este campo es requerido',
            'name.string' => 'El valor no es correcto',
            'name.max' => 'Solo se permiten 255 caracteres',
           // 'name.unique' => 'El producto ya esta registrado',

            'image.required' => 'El campo es requerido',
            'image.dimensions' => 'Solo se permiten imágenes de 500x500 px.',

            'sell_price.required' => 'Este campo es requerido',

            'category.integer' => 'El valor tiene que ser entero',
            'category.required' => 'El campo es requerido',
   

            'provider.integer' => 'El valor tiene que ser entero',
            'provider.required' => 'El campo es requerido',

            'code.unique' => 'El codigo ya esta registrado',
            
            'code.max' => 'Solo se permiten 13 digitos',
            'code.min' => 'Solo se permiten 13 digitos',
          
        ];
    }
}
