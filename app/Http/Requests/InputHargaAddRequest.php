<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputHargaAddRequest extends FormRequest
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
            
				"tanggal" => "required|date",
				"harga" => "nullable|array",
				"harga.*" => "nullable|numeric",
				"kebutuhan" => "nullable|array",
				"kebutuhan.*" => "nullable|numeric",
				"ketersediaan" => "nullable|array",
				"ketersediaan.*" => "nullable|numeric",
            
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
