<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Penjual_Ayam_PotongAddRequest extends FormRequest
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
            
				"nama_pedagang" => "required|string",
				"lokasi_penjual" => "required|string",
				"kapasitas_max" => "required|numeric",
				"kontak_hp" => "required|string",
				"legalitas" => "required|numeric",
				"ket_legalitas" => "required|string",
				"visibility" => "required",
				"status" => "required",
            
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
