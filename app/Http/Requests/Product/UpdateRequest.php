<?php

namespace App\Http\Requests\Product;

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
            'name'=> 'required|string|unique:products,name,'.$this->route('product')->id.' |max:255',
            'image'=> 'nullable|dimensions:min_width=100,min_height=200',
            'description'=> 'nullable|string|max:250',
            'code'=> 'string|min:8|unique:products,code,'. $this->route('product')->id.'|max:8',
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
            'name.unique' => 'El producto ya esta registrado',

            'image.required' => 'El campo es requerido',
            'image.dimensions' => 'Solo se permiten imágenes de 100x200 px.',

            'sell_price.required' => 'Este campo es requerido',

            'category.integer' => 'El valor tiene que ser entero',
            'category.required' => 'El campo es requerido',
            

            'provider.integer' => 'El valor tiene que ser entero',
            'provider.required' => 'El campo es requerido',

            'code.unique' => 'El codigo ya esta registrado',
            'code.integer' => 'El valor no es correcto',
            'code.max' => 'Solo se permiten 13 digitos',
            'code.min' => 'Solo se permiten 13 digitos',
      
        ];
    }
}
