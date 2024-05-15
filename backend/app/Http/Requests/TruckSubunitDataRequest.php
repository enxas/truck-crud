<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class TruckSubunitDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'main_truck' => ['required', 'integer'],
            'subunit' => ['required', 'integer'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ];
    }

	public function after(): array
	{
		return [
			function (Validator $validator) {
				$start_date = $validator->safe()->start_date;
				$end_date = $validator->safe()->end_date;

				if(strtotime($end_date) <= strtotime($start_date)) {
					$validator->errors()->add('start_date', 'Start date must be earlier than end date');
				}
			}
		];
	}
}
