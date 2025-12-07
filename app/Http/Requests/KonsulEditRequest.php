<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KonsulEditRequest extends FormRequest
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
            
				"nama_lengkap" => "filled|string",
				"id_user" => "filled|numeric",
				"pertanyaan" => "filled",
				"jawaban" => "filled",
				"id_jenis" => "filled|numeric",
				"status" => "filled|numeric",
				"is_publish" => "filled|numeric",
            
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
