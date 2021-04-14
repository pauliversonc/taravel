<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTouristDestinationRequest extends FormRequest {

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
            'destination_name' => 'required', 
            'destination address' => 'required', 
            'destination website' => 'required', 
            'categorytags_id' => 'required', 
            'this_is_for' => 'required', 
            'description' => 'required', 
            
		];
	}
}
