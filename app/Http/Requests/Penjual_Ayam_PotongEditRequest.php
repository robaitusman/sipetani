<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Penjual_Ayam_PotongEditRequest extends FormRequest
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
            
				"nama_pedagang" => "filled|string",
				"lokasi_penjual" => "filled|string",
				"kapasitas_max" => "filled|numeric",
				"kontak_hp" => "filled|string",
				"legalitas" => "filled|numeric",
				"ket_legalitas" => "filled|string",
				"visibility" => "filled",
				"status" => "filled",
            
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
