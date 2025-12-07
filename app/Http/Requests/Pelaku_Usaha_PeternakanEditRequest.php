<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Pelaku_Usaha_PeternakanEditRequest extends FormRequest
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
            
				"nama_usaha" => "filled|string",
				"nama_pemilik" => "filled|string",
				"lokasi" => "filled|string",
				"rt" => "filled|string",
				"rw" => "filled|string",
				"id_wilayah" => "filled",
				"legalitas" => "filled|string",
				"status_kelompok" => "filled|string",
				"legalitas_produksi" => "filled|string",
				"jenis_olahan" => "filled|string",
				"komoditas" => "filled|string",
				"satuan" => "filled|string",
				"jml_produksi" => "filled|numeric",
				"omzet" => "filled|numeric",
				"sumber_bahan_baku" => "filled|string",
				"metode_penjualan" => "filled|string",
				"visibility" => "filled",
				"status" => "filled",
				"photo" => "filled",
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
