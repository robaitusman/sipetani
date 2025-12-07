<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Gudang_TelurEditRequest extends FormRequest
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
            
				"nama_unit_usaha" => "filled|string",
				"nama_pemilik" => "filled|string",
				"alamat" => "filled|string",
				"rt" => "filled|string",
				"rw" => "filled|string",
				"kapasitas" => "filled|string",
				"keterangan" => "filled",
				"id_wilayah" => "filled",
				"legalitas" => "filled|numeric",
				"ket_legalitas" => "filled|string",
				"status" => "filled",
				"visibility" => "filled",
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
