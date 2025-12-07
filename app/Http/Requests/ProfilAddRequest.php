<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilAddRequest extends FormRequest
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
            
				"id_jenis" => "nullable",
				"judul" => "nullable|string",
				"deskripsi" => "required",
				"layanan" => "nullable",
				"jam_kerja" => "nullable",
				"photo" => "nullable",
				"video" => "nullable",
				"penulis" => "required",
				"alamat" => "required|string",
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
