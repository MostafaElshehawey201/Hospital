<?php

namespace App\Http\Requests\Auth;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "string",
                "min:3",
                "max:255",
                "regex:/^[\pL\s]+$/u",
            ],
            "email" => [
                "required",
                "unique:users,email",
                "email:rfc,dns",
            ],
            "phone" => [
                "required",
                "unique:users,phone",
                "regex:/^01(0|1|2|5)[0-9]{8}$/",
            ],
            "password" => [
                "required",
                "confirmed",
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.name.required'),
            'name.string' => __('validation.name.string'),
            'name.min' => __('validation.name.min'),
            'name.max' => __('validation.name.max'),
            'name.regex' => __('validation.name.regex'),

            'email.required' => __('validation.email.required'),
            'email.email' => __('validation.email.email'),
            'email.unique' => __('validation.email.unique'),

            'phone.required' => __('validation.phone.required'),
            'phone.regex' => __('validation.phone.regex'),
            'phone.unique' => __('validation.phone.unique'),

            'password.required' => __('validation.password.required'),
            'password.confirmed' => __('validation.password.confirmed'),
            'password.min' => __('validation.password.min'),
            'password' => __('validation.password.rules'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = [];
        foreach ($validator->errors()->getMessages() as $key => $value) {
            $errors[$key] = $value;
        }
        throw new HttpResponseException(
            response()->json([
                "success" => false,
                "data" => null,
                "errors" => $errors,
            ],422),
        );
    }
}
