<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodeEvaluasiAddRequest extends FormRequest
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
            
				"tahun" => "required|string",
				"nama_periode" => "required|string",
				"deskripsi" => "nullable",
				"tanggal_mulai" => "required|date",
				"tanggal_selesai" => "required|date",
				"status_periode" => "required",
            
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
