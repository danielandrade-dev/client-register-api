<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('client');
        return [
            'name' => 'sometimes|string|max:150',
            'email' => 'sometimes|email|unique:clients,email,' . $id . '|max:150',
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string',
        ];
    }
}
