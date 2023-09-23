<?php

namespace App\Http\Requests;

use App\Enums\GarageUserType;
use App\Models\Garage\GarageUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AccountUpdateRequest extends FormRequest
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
        $garage_user = GarageUser::where('email', auth()->user()->email)->first();
        $is_garage = $garage_user?->type === GarageUserType::Admin;

        return [
            'company_name' => [$is_garage ? 'required' : 'nullable', 'string', 'max:255', $is_garage ? Rule::unique('companies', 'name')->ignore(request()->user()->company) : ''],
            'company_address' => [$is_garage ? 'required' : 'nullable', 'string', 'max:255'],
            'company_telephone' => [$is_garage ? 'required' : 'nullable', 'string', 'min:4', 'max:17'],
            'user_role' => [$is_garage ? 'required' : 'nullable', 'string', 'max:255'],
            'postcode' => [$is_garage ? 'required' : 'nullable', 'string', 'max:7'],
            'opening' => [$is_garage ? 'required' : 'nullable'],
            'closing' => [$is_garage ? 'required' : 'nullable'],
            'vehicles' => [$is_garage ? 'required' : 'nullable', 'array'],
            'is_mot' => [$is_garage ? 'required' : 'nullable'],
            'is_services' => [$is_garage ? 'required' : 'nullable'],
            'is_repairs' => [$is_garage ? 'required' : 'nullable'],
            'is_recovery' => [$is_garage ? 'required' : 'nullable'],
            'out_of_hour_response' => [$is_garage ? 'required' : 'nullable'],
            'country' => [$is_garage ? 'required' : 'nullable', 'string', 'max:255'],
            'city' => [$is_garage ? 'required' : 'nullable', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'min:4', 'max:17'],
            'mobile' => ['required', 'string', 'min:4', 'max:17'],
            // 'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user())],
            'password' => ['nullable', 'string', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()]
        ];
    }
}
