<?php

namespace App\Http\Requests\Provider;

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
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|string|max:200|unique:providers',
            'ruc_number'=> 'required|string|max:11|min:11|unique:providers',
            'address'=> 'nullable|string|max:255',
            'phone'=> 'required|string|max:8|min:8|unique:providers',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Este campo es requerido',
            'name.string' => 'El valor no es correcto',
            'name.max' => 'Solo se permiten 255 caracteres',

            'email.required' => 'Este campo es requerido',
            'email.email' => 'No es un correo electronico',
            'email.string' => 'El valor no es correcto',
            'email.max' => 'Solo se permiten 255 caracteres',
            'email.unique' => 'Ya se encuentra registrado',

            'ruc_number.required' => 'Este campo es requerido',
            'ruc_number.string' => 'El valor no es correcto',
            'ruc_number.max' => 'Solo se permiten 11 caracteres',
            'ruc_number.min' => 'Se requiere 11 caracteres',
            'ruc_number.unique' => 'Ya se encuentra registrado',
           
            'address.string' => 'El valor no es correcto',
            'address.max' => 'Solo se permiten 255 caracteres',
            
            'phone.required' => 'Este campo es requerido',
            'phone.string' => 'El valor no es correcto',
            'phone.max' => 'Solo se permiten 8 caracteres',
            'phone.max' => 'Se requiere 8 caracteres',
            'phone.unique' => 'Ya se encuentra registrado',

        ];
    }
}
