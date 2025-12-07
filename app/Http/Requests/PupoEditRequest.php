<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PupoEditRequest extends FormRequest
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
            
				"nik" => "filled|string",
				"nama_pemilik" => "filled|string",
				"nama_usaha" => "filled|string",
				"nama_produk" => "filled|string",
				"alamat" => "filled|string",
				"id_wilayah" => "filled",
				"rt" => "filled|string",
				"rw" => "filled|string",
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
