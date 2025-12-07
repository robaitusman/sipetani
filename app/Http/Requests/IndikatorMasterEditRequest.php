<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndikatorMasterEditRequest extends FormRequest
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
            
				"bidang" => "filled",
				"sasaran_program" => "filled",
				"indikator_kinerja" => "filled",
				"satuan" => "filled|string",
				"urutan" => "filled|numeric",
				"is_active" => "filled|numeric",
            
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
