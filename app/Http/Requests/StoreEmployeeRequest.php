<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:employees,name',
            'position' => 'required|string|in:frontend,backend,fullstack,mobileApp,socialMedia,ui/ux,customerService,seo',
            'salary' => 'required|numeric|min:5000',
            'payment_time' => 'required|date',
        ];
    }
}
