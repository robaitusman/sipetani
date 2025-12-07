<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Harga_TernakEditRequest extends FormRequest
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
				"tanggal" => "filled|date",
				"penulis" => "filled|numeric",
				"daging_sapi" => "filled|numeric",
				"daging_ayam" => "filled|numeric",
				"daging_kambing" => "filled|numeric",
				"daging_babi" => "filled|numeric",
				"harga_telur" => "filled|numeric",
				"daging_bebek" => "filled|numeric",
            
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
