<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'name' => [
                'required', 'min:3', 'max:255',
            ],
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'admin' => ['nullable'],
            'image' => [
                'nullable', 'image',
                'max:2048',
                'dimensions:max_width=1024,max_height=1024',
            ],
        ];
    }
}
