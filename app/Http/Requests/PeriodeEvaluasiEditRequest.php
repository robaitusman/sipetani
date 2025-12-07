<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodeEvaluasiEditRequest extends FormRequest
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
            
				"tahun" => "filled|string",
				"nama_periode" => "filled|string",
				"deskripsi" => "nullable",
				"tanggal_mulai" => "filled|date",
				"tanggal_selesai" => "filled|date",
				"status_periode" => "filled",
            
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
