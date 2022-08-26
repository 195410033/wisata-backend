<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ObjekRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        return [
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'ltd' => 'required|numeric',
            'lngtd' => 'required|numeric',
            'kategori_id' => 'required|exists:kategori,id'
        ];        
    }
}
