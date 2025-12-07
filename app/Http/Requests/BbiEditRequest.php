<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BbiEditRequest extends FormRequest
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
            
				"nama" => "filled|string",
				"kapasitas" => "filled|string",
				"alamat" => "filled|string",
				"id_wilayah" => "filled",
				"rt" => "filled|string",
				"rw" => "filled|string",
				"legalitas" => "filled|numeric",
				"ket_legalitas" => "filled|string",
				"visibility" => "filled",
				"status" => "filled",
				"photo" => "filled",
				"lokasi" => "filled|string",
				"long" => "filled|string",
				"lat" => "filled|string",
            
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
