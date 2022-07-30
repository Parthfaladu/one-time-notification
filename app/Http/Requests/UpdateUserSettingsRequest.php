<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSettingsRequest extends FormRequest
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
            "isSendNotification" => "boolean",
            "email"              => "required|email",
            "phoneNumber"        => 'phone:AUTO,mobile'
        ];
    }

    /**
     * Get validation rules messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            "phoneNumber.phone" => "Invalid phone number, please enter phone number with country code."
        ];
    }
}
