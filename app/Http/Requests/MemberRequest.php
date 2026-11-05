<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
        $memberId = is_object($this->member) ? $this->member->id : $this->member;

        return [
            'name'=>['required','max:255'],
            'email' => ['required','email','max:100',Rule::unique('users', 'email')->ignore($memberId),],
            'phone_number' => ['required','max:100'],
        ];
    }
}
