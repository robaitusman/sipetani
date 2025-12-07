<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Harga_TernakAddRequest extends FormRequest
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
            
				"sapi" => "nullable|numeric",
				"kambing" => "nullable|numeric",
				"domba" => "nullable|numeric",
				"ayam_pedaging" => "nullable|numeric",
				"ayam_petelor" => "nullable|numeric",
				"ayam_petelor_afkir" => "nullable|numeric",
				"burung_puyuh" => "nullable|numeric",
				"burung_dara" => "nullable|numeric",
				"itik" => "nullable|numeric",
				"entok" => "nullable|numeric",
				"susu_sapi" => "nullable|numeric",
				"susu_kambing" => "nullable|numeric",
				"tanggal" => "required|date",
				"penulis" => "required|numeric",
				"daging_sapi" => "required|numeric",
				"daging_ayam" => "required|numeric",
				"daging_kambing" => "required|numeric",
				"daging_babi" => "required|numeric",
				"harga_telur" => "required|numeric",
				"daging_bebek" => "required|numeric",
            
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
