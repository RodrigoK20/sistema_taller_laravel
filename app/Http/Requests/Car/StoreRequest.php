<?php

namespace App\Http\Requests\Car;

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
            'brand'=> 'required|string|max:150',
            'model'=> 'required|string|max:250',
            'license_plate'=> 'required|string|max:250|unique:cars|max: 8',
            'year'=> 'required|numeric|min:4|',
            'viscosity'=> 'nullable|string',


        ];
    }

    public function messages(){
        return [
            'brand.required' => 'Este campo es requerido',
            'brand.string' => 'El valor no es correcto',
            'brand.max' => 'Solo se permiten 150 caracteres',
           
            'model.required' => 'Este campo es requerido',
            'model.string' => 'El valor no es correcto',
            'model.max' => 'Solo se permiten 250 caracteres',

            'license_plate.required' => 'Este campo es requerido',
            'license_plate.string' => 'El valor no es correcto',
            'license_plate.max' => 'Solo se permiten 8 caracteres',
            'license_plate.unique'=> 'El numero de placa ya se encuentra registrado en un vehiculo',

            'year.required' => 'Este campo es requerido',
            'year.numeric' => 'El valor no es correcto',
           // 'year.max' => 'Solo se permiten 4 caracteres como maximo',
            'year.min' => 'Solo se permiten 4 caracteres como minimo',

            'viscosity.string' => 'El valor no es correcto',

        ];  
       
    }
}
