<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoodsRequest extends FormRequest
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
            'id' => 'required|exists:goods,id',
            'code' => 'required|unique:goods,code,' . $this->get('id'),
            'name' => 'required|unique:goods,name,' . $this->get('id'),
            'unit_of_good_id' => 'required|exists:unit_of_goods,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Lỗi bị miss goods_id',
            'id.exists' => 'Lỗi bị không tìm thấy goods_id trong db',
            'code.required' => 'Vui lòng nhập Mã Hàng',
            'code.unique' => 'Mã Hàng đã tồn tại',
            'name.required' => 'Vui lòng nhập Tên Hàng',
            'name.unique' => 'Tên Hàng đã tồn tại',
            'unit_of_good_id.required' => 'Lỗi bị miss unit_id',
            'unit_of_good_id.exists' => 'Lỗi ĐVT không tồn tại',
        ];
    }
}
