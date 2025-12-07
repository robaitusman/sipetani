<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KonsultasiAddRequest extends FormRequest
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
            
				"tanggal" => "required|date",
				"penulis" => "required|numeric",
				"nama" => "required|string",
				"pertanyaan" => "required",
				"jawaban" => "required",
				"status" => "required|numeric",
				"jenis" => "required|numeric",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
