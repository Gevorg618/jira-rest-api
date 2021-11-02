<?php

namespace App\Http\Requests;

use App\Rules\UpperCase;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class IssueCreateRequest
 * @package App\Http\Requests
 */
class IssueCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'key'         => ['required', 'alpha', new UpperCase],
            'description' => 'required',
            'summary'     => 'required',
            'due_date'    => 'sometimes|date_format:Y-m-d|after:today'
        ];
    }


    /**
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
