<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MountaineeringRequest extends FormRequest
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
            'type_of_activity1' => 'required',
            'licence_number' => 'required|unique:mountaineerings,licence_number',
            //'licence_number' => 'unique:projects,licence_number_new',
            'licence_given_date' => 'required',
            'organization_inn' => 'required|unique:mountaineerings,organization_inn',
            //'organization_name' => 'required|unique:projects,organization_name',
            //'organization_phone' => 'required|unique:projects,organization_phone',
            'organization_account_number' => 'required|unique:mountaineerings,organization_account_number',
            //'license_direction' => 'required'
        ];
    }
}
