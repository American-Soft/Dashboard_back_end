<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestReqest extends FormRequest
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
            'city'                 => ['nullable', 'string', 'max:100'],
            'governorate'          => ['nullable', 'string', 'max:100'],
            'region'               => ['nullable', 'string', 'max:100'],
            'address'              => ['nullable', 'string', 'min:10'],
            'status'               => ['nullable', 'string', 'max:150'],
            'problem_description'  => ['nullable', 'string', 'min:10'],
            'warranty_status'      => ['nullable', 'boolean'],
            'note'                 => ['nullable', 'string','min:5'],
            'domain'               => ['nullable', 'string', 'url'],
        ];
    }
}
