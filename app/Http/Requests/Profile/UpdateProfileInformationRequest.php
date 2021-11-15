<?php

namespace App\Http\Requests\Profile;

use App\Rules\Alpha;
use App\Rules\HomePhoneNumber;
use App\Rules\NickName;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', new Alpha, 'min:3', 'max:35'],
            'last_name' => ['required', 'string', new Alpha, 'min:3', 'max:35'],
            'username' => ['required', 'string', new NickName, 'min:5', 'max:20',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'birthdate' => ['nullable', 'string', 'date_format:d/m/Y',
                'after_or_equal:' . date('Y-m-d', strtotime('-70 years')),
                'before_or_equal:' . date('Y-m-d', strtotime('-18 years')),
            ],
            'phone_number' => ['required', 'numeric', new PhoneNumber, 'digits:10'],
            'home_phone_number' => ['required', 'numeric', new HomePhoneNumber, 'digits:9'],
            'address' => ['required', 'string', 'min:5', 'max:50'],
        ];
    }
}
