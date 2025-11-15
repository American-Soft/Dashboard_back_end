<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
            'name' => ['nullable','string','max:255' , Rule::unique('employees', 'name')->ignore($this->route('employeeId'))],
            'position' => ['nullable','string','in:frontend,backend,fullstack,mobileApp,socialMedia,ui/ux,customerService,seo'],
            'salary' => ['nullable','numeric','min:5000'],
            'payment_time' => ['nullable','date'],
        ];
    }
}
