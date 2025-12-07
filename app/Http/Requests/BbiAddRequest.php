<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BbiAddRequest extends FormRequest
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
            
				"nama" => "required|string",
				"kapasitas" => "required|string",
				"alamat" => "required|string",
				"id_wilayah" => "required",
				"rt" => "required|string",
				"rw" => "required|string",
				"legalitas" => "required|numeric",
				"ket_legalitas" => "required|string",
				"visibility" => "required",
				"status" => "required",
				"photo" => "required",
				"lokasi" => "required|string",
				"long" => "required|string",
				"lat" => "required|string",
            
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
