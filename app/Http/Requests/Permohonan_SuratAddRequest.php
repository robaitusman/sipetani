<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Permohonan_SuratAddRequest extends FormRequest
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
            
				"id_jenis" => "required",
				"tgl_pengesahan" => "required|date",
				"tgl_permohonan" => "required|date",
				"nik" => "required|string",
				"nama" => "required|string",
				"alamat" => "required|string",
				"id_wilayah" => "required",
				"status_surat" => "required|numeric",
				"id_user" => "required|numeric",
				"kelengkapan_dokumen" => "required",
            
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
