<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyJobRequest extends FormRequest
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
            'career_id' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required',
            'resume' => 'required|file|mimes:doc,pdf,docx,zip|max:5000',
        ];
    }
}
