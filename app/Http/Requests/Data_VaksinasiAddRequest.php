<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Data_VaksinasiAddRequest extends FormRequest
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
            
				"tanggal_vaksin" => "required|date",
				"id_petugas" => "required|numeric",
				"id_vaksin" => "required|numeric",
				"nama_pemilik" => "required|numeric",
				"alamat" => "required|string",
				"rt" => "required|string",
				"rw" => "required|string",
				"id_wilayah" => "required|numeric",
            
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
