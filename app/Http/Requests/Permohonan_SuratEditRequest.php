<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Permohonan_SuratEditRequest extends FormRequest
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
            
				"id_jenis" => "filled",
				"tgl_pengesahan" => "filled|date",
				"tgl_permohonan" => "filled|date",
				"nik" => "filled|string",
				"nama" => "filled|string",
				"alamat" => "filled|string",
				"id_wilayah" => "filled",
				"status_surat" => "filled|numeric",
				"id_user" => "filled|numeric",
				"kelengkapan_dokumen" => "filled",
            
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
