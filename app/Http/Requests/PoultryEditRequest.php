<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoultryEditRequest extends FormRequest
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
				"nama_pemilik" => "filled|string",
				"no_hp_pemilik" => "filled|string",
				"nama_penanggung_jawab" => "filled|string",
				"no_hp_penanggung_jawab" => "filled|string",
				"nama_sdm" => "filled|string",
				"no_hp_sdm" => "filled|string",
				"kapasitas" => "filled|string",
				"alamat" => "filled|string",
				"id_wilayah" => "filled",
				"rt" => "filled|string",
				"rw" => "filled|string",
				"legalitas" => "filled|numeric",
				"ket_legalitas" => "filled|string",
				"visibility" => "nullable",
				"status" => "nullable",
				"photo" => "nullable",
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
