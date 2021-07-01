<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //aqui es para verificar el rol de los usuarios a ver si puede crear un nuevo video, en este caso todos
                    //pueden
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'video' => 'required | mimes:mp4,MP4 | max:5000',
            'image' => 'required | mimes:jpg,bmp,png,jpeg | max:3000',
            'title' => 'required | max: 30',
            'description' => 'required | max: 150',
        ];
    }

    public function messages()
    {
        return [
            'video.required' => 'Debes agregar un video',
            'video.mimes' => 'Parece que has agregado un archivo que no es un video (MP4)',
            'video.max' => 'El video pesa mucho, debe pesar maximo 5 Megas',
            'image.required' => 'Debes agregar una miniatura para tu video',
            'image.mimes' => 'Parece que has agregado un archivo que no es una imagen',
            'image.max' => 'La imagen pesa mucho, debe pesar maximo 3 Megas',
            'title.required' => 'Tu video necesita un titulo',
            'title.max' => 'El titulo el muy largo, maximo 30 caracteres',
            'description.required' => 'Tu video necesita una descripcion',
            'description.max' => 'La descripcion es muy larga, maximo 150 caracteres',
        ];
    }
}
