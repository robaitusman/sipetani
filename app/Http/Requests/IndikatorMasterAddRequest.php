<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndikatorMasterAddRequest extends FormRequest
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
            
				"bidang" => "required",
				"sasaran_program" => "required",
				"indikator_kinerja" => "required",
				"satuan" => "required|string",
				"urutan" => "required|numeric",
				"is_active" => "required|numeric",
            
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
