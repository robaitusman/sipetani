<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KonsulAddRequest extends FormRequest
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
            
				"nama_lengkap" => "required|string",
				"id_user" => "required|numeric",
				"pertanyaan" => "required",
				"jawaban" => "required",
				"id_jenis" => "required|numeric",
				"status" => "required|numeric",
				"is_publish" => "required|numeric",
            
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
