<?php

namespace App\Http\Requests\Workshop;

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
            
            'name_service'=> 'required|string|unique:workshops,name_service,'.$this->route('workshop')->id.' |max:255',
            'description'=> 'nullable|string|max:250',
            'cost'=> 'required|',
            'category_work_id'=> 'required|integer',
        ];
    }


    public function messages(){
        return [

            'name_service.required' => 'Este campo es requerido',
            'name_service.string' => 'El valor no es correcto',
            'name_service.max' => 'Solo se permiten 255 caracteres',
            'name_service.unique' => 'El nombre del servicio ya esta registrado',

            'description.string' => 'El valor no es correcto',
            'description.max' => 'Solo se permiten 255 caracteres',

            'cost.required' => 'Este campo es requerido',

            'category_work_id.integer' => 'El valor tiene que ser entero',
            'category_work_id.required' => 'El campo es requerido',
          
        ];
    }
}
