<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Factory;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->isEmail($this->get('username'))) {
            return [
                'username' => 'required|exists:usuario,email',
                'password' => 'required | min:8',
            ];
        }
        return [
            'username' => 'required|exists:usuario',
            'password' => 'required | min:8',
        ];
    }

    public function getCredentials()
    {
        $username = $this->get('username');
        if ($this->isEmail($username)) {
            return [
                'email' => $username,
                'password' => $this->get('password')
            ];
        }
        return $this->only('username', 'password');
    }

    public function messages(): array
    {
        return [
            'username.required' => 'El nombre de usuario es requerido',
            'username.exists' => 'El usuario o correo no estan registrados',
            'password.required' => 'La contrasenha es requerida',
            'password.min' => 'La contrasenha debe tener al menos 8 caracteres',
        ];
    }

    public function isEmail($value)
    {
        $factory = $this->container->make(Factory::class);
        return !$factory->make(['username' => $value], ['username' => 'email'])->fails();
    }
}
