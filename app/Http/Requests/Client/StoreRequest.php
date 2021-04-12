<?php

namespace App\Http\Requests\Client;

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
            'dui'=> 'nullable|string|max:8|unique:clients',
            'address'=> 'nullable|string|max:255',
            'phone'=> 'required|string|max:8|min:8|unique:clients',
            'email'=> 'nullable|string|max:255|unique:clients|email:rfc,dns',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Este campo es requerido',
            'name.string' => 'El valor no es correcto',
            'name.max' => 'Solo se permiten 255 caracteres',

            //'dui.required' => 'Este campo es requerido',
            'dui.string' => 'El valor no es correcto',
            'dui.unique' => 'Este DUI ya se encuentra registrado',
            'dui.min' => 'Se requiere de 8 caracteres',
            'dui.max' => 'Solo se permiten 8 caracteres',

            'address.string' => 'El valor no es correcto',
            'address.max' => 'Solo se permiten 255 caracteres',
            
            'phone.required' => 'Este campo es requerido',
            'phone.string' => 'El valor no es correcto',
            'phone.unique' => 'Este telefono ya se encuentra registrado',
            'phone.min' => 'Se requiere de 8 caracteres',
            'phone.max' => 'Solo se permiten 8 caracteres',
            

            
            'email.string' => 'El valor no es correcto',
            'email.max' => 'Solo se permiten 255 caracteres',
            'email.email' => 'No es un correo electronico',

            
        ];
    }
}
