<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeternakAddRequest extends FormRequest
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
            
				"nik" => "required|string",
				"nama" => "nullable|string",
				"alamat" => "required|string",
				"rt" => "required|string",
				"rw" => "required|string",
				"long" => "nullable|string",
				"lat" => "nullable|string",
				"photo" => "nullable",
				"id_jenis_hewan" => "nullable",
				"jumlah_populasi" => "nullable|numeric",
				"produksi" => "nullable|numeric",
				"id_wilayah" => "required",
            
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
