<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequestReqest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'         => ['nullable', 'integer', 'exists:requests,id'],
            'phone'      => ['nullable','regex:/^01[0125][0-9]{8}$/','exists:requests,phone_number'],
            'brand_name' => ['nullable', 'string', 'exists:brands,name'],
            'status'     => ['nullable', 'in:pending,approved,rejected,completed'], 
            'created_at' => ['nullable', 'date'],
            'domain'     => ['nullable', 'string', 'url','exists:requests,domain'],
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists'          => 'The Customer Request selected does not exist.',
            'phone_number.regex' => 'The phone number must be a valid Egyptian number.',
            'phone.exists'       => 'This phone number not exists',
            'brand_name.exists'  => 'The selected brand does not exist.',
            'status.in'          => 'Status must be one of: pending, approved, rejected, or completed.',
            'created_at.date'    => 'Please provide a valid date.',
            'domain.exists'      => 'This domain not exists'
        ];
    }
}
