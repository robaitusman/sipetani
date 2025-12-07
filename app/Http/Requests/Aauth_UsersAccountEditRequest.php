<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Aauth_UsersAccountEditRequest extends FormRequest
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
            
				"oauth_uid" => "nullable",
				"oauth_provider" => "nullable|string",
				"username" => "filled|string",
				"full_name" => "filled|string",
				"avatar" => "filled",
				"banned" => "nullable|numeric",
				"no_hp" => "filled|string",
            
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
