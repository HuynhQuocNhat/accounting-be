<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitOfGoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['id'] = $this->route('id');
        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:unit_of_goods,id',
            'name' => 'required|unique:unit_of_goods,name'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập ĐVT vào !!!',
            'name.unique' => 'Không thể sữa vì ĐVT đã tồn tại'
        ];
    }
}
