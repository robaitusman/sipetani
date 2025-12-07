<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Pelaku_Usaha_PeternakanAddRequest extends FormRequest
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
            
				"nama_usaha" => "required|string",
				"nama_pemilik" => "required|string",
				"lokasi" => "required|string",
				"rt" => "required|string",
				"rw" => "required|string",
				"id_wilayah" => "required",
				"legalitas" => "required|string",
				"status_kelompok" => "required|string",
				"legalitas_produksi" => "required|string",
				"jenis_olahan" => "required|string",
				"komoditas" => "required|string",
				"satuan" => "required|string",
				"jml_produksi" => "required|numeric",
				"omzet" => "required|numeric",
				"sumber_bahan_baku" => "required|string",
				"metode_penjualan" => "required|string",
				"visibility" => "required",
				"status" => "required",
				"photo" => "required",
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
