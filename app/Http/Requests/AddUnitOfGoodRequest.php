<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class AddUnitOfGoodRequest extends FormRequest
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
            'unit' => 'array|present',
            'unit.*' => 'required|unique:unit_of_goods,name'
        ];
    }

    public function messages(): array
    {
        return  [
            'unit.present' => 'Chưa nhập đơn vị tính kìaaaa !!',
            'unit.*.required' => 'Chưa nhập đơn vị tính kìaaaa !!',
            'unit.*.unique' => 'ĐVT này đã có rồi nhaaaa !!'
        ];
    }

    public function failedValidation($validator)
    {
        if ($this->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(
                response()->json([
                    'data' => $errors,
                    'status' => 422
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }
}
