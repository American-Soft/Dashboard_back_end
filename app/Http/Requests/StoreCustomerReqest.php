<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerReqest extends FormRequest
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
            'full_name'            => ['required', 'string', 'max:150'],
            'phone_number'         => ['required' , 'regex:/^01[0-2,5]{1}[0-9]{8}$/'],
            'whatsapp_number'      => ['required', 'string', 'regex:/^[0-9]{8,15}$/'],
            'whatsapp_number_code' => [
                'required',
                'string',
                'regex:/^\+\d{1,4}$/'
            ],
            'address'              => ['required', 'string', 'max:255'],
            'email'                => ['nullable', 'email', 'max:255'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $validCodes = [
                '+20', '+966', '+971', '+965', '+973', '+974', '+968', '+962',
                '+961', '+964', '+212', '+213', '+216', '+218', '+249', '+963', '+967',
                '+1', '+44', '+33', '+49', '+39', '+34', '+90', '+91', '+81', '+86'
            ];

            $code = $this->input('whatsapp_number_code');

            if (!in_array($code, $validCodes)) {
                $validator->errors()->add(
                    'whatsapp_number_code',
                    'the selected whatsapp number code is invalid.'
                );
            }
        });
    }
}
