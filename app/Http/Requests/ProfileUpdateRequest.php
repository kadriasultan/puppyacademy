<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'dogs' => ['sometimes', 'array'],
            'dogs.*.id' => ['sometimes', 'exists:dogs,id'],
            'dogs.*.name' => ['required', 'string', 'max:255'],
            'dogs.*.nickname' => ['required', 'string', 'max:255'],
            'dogs.*.breed' => ['required', 'string', 'max:255'],  // Validatie voor ras
            'dogs.*.age' => ['required', 'integer', 'min:0'],
        ];
    }
}
