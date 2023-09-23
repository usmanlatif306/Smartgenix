<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'department' => ['required', 'in:support,billing,sales,feature'],
            'priority' => ['required', 'in:low,medium,high'],
            'service_type' => ['required'],
            'subject' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:unanswered,answered,completed'],
        ];
    }
}
