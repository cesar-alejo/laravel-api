<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    protected $complementedData;

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
            'name' => 'required|string|min:10|max:100',
            'expiration' => 'required|date|after:tomorrow',
            'details' => 'max:256',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if (empty(session('office_id')) || empty(session('office_code'))) {
                $validator->errors()->add('office', 'El usuario no tiene ninguna oficina asociada.');
            }
        });
    }

    //protected function prepareForValidation()
    //{
    //    // Modificar datos antes de la validación
    //    $this->merge([
    //        'name' => ucwords($this->name),
    //    ]);
    //}

    public function complementData()
    {
        $this->complementedData = $this->validated();
        $this->complementedData['user_id'] = Auth::id();
        $this->complementedData['office_id'] = session('office_id');
        $this->complementedData['office_code'] = session('office_code');

        return $this->complementedData;
    }

    public function getComplementedData()
    {
        return $this->complementedData ?: $this->complementData();
    }

    /**
     * Auto errores to validations
     *
     * @param Validator $validator
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Validations errors',
                'data' => $validator->errors()
            ], 422));
        }

        parent::failedValidation($validator);
    }
}
