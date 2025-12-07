<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Gudang_TelurAddRequest extends FormRequest
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
            
				"nama_unit_usaha" => "required|string",
				"nama_pemilik" => "required|string",
				"alamat" => "required|string",
				"rt" => "required|string",
				"rw" => "required|string",
				"kapasitas" => "required|string",
				"keterangan" => "required",
				"id_wilayah" => "required",
				"legalitas" => "required|numeric",
				"ket_legalitas" => "required|string",
				"status" => "required",
				"visibility" => "required",
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
