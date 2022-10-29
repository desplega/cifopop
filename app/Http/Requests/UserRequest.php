<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => "required|unique:users,email,{$this->user->id}|email",
            'city' => 'required|max:16',
            'phone' => 'nullable|regex:/^[6,7,9]{1}[0-9]{8}$/'
        ];
    }
}
