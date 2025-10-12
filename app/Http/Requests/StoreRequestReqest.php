<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestReqest extends FormRequest
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
            'city'                 => ['required', 'string', 'max:100'],
            'governorate'          => ['required', 'string', 'max:100'],
            'region'               => ['required', 'string', 'max:100'],
            'address'              => ['required', 'string', 'min:10'],
            'status'               => ['required', 'string', 'max:150'],
            'problem_description'  => ['required', 'string', 'min:10'],
            'warranty_status'      => ['required', 'boolean'],
            'note'                 => ['required', 'string','min:5'],
            'domain'               => ['required', 'string', 'url'],
        ];
    }
}
