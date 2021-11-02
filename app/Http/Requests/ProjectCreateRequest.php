<?php

namespace App\Http\Requests;

use App\Rules\UpperCase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class ProjectCreateRequest
 * @package App\Http\Requests
 */
class ProjectCreateRequest extends FormRequest
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
            'key'          => ['required', 'alpha', new UpperCase],
            'name'         => 'required',
            'project_type' => 'required',
            'description'  => 'required',
            'account_id'   => 'required',
            'url'          => 'required',
            'avatar_id'    => 'required|integer',
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
