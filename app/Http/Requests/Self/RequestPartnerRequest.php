<?php

namespace App\Http\Requests\Self;

use App\Services\Mapper\Facades\Mapper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestPartnerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'partner_type' => 'required_if:type,partner|in:advocate,notary|nullable',
            'address' => 'required_if:type,partner',
            'partner_license' => 'required_if:type,partner|max:150',
            'company' => 'required_if:type,partner|max:150',
            'company_license' => 'required_if:type,partner|max:150',

            'headline' => 'required_if:type,partner|max:150',
            'education' => 'required_if:type,partner',
            'experience' => 'required_if:type,partner',
            'certification' => 'required_if:type,partner',
            'categories' => 'required|array',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Mapper::validation($validator, $this->method()));
    }
}
