<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNotificationRequest extends FormRequest
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
            "notificationType" => "required|in:marketing,invoices,system",
            "shortMessage"     => "required:max:100",
            "expireAt"         => "required|date_format:d/m/Y",
            "destination"      => "required"
        ];
    }
}
