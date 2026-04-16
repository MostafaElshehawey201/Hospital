<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
            "login" => "required",
            "password" => "required",
            Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
        ];
    }

    public function messages(){
        return [
            "login.required" => __('validation.login.required'),
            "password.required" => __('validation.password.required'),
            "password.rules" => __('validation.password.rules'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = [];
        foreach($validator->errors()->getMessages() as $key => $value){
            $errors[$key] = $value;
        }
        throw new HttpResponseException(
            response()->json([
                "success" => false,
                "data" => null,
                "errors" => $errors
            ],422)
        );
    }
}
