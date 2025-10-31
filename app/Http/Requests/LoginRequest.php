<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:191'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Retrieve the login credentials for the request.
     */
    public function getCredentials(): array
    {
        return [
            'username' => $this->input('username'),
            'password' => $this->input('password'),
        ];
    }
}
