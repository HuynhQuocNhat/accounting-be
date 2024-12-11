<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddGoodRequest extends FormRequest
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
        $data['goods'] = array_filter(parent::all());

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
            "goods" => "present|array|min:1",
            "goods.*.code" => "required|unique:goods,code|distinct",
            "goods.*.name" => "required|unique:goods,name|distinct",
            "goods.*.unit_of_good_id" => "required|exists:unit_of_goods,id",
        ];
    }

    public function messages(): array
    {
        return [
          "goods.present" => "Phải có ít nhất 1 row mới thêm Hàng Hóa mới.",
          "goods.*.code.required" => "[STT :position] : Hoa chưa nhập Mã Hàng",
          "goods.*.code.unique" => "[STT :position] : Mã Hàng đã tồn tại",
          "goods.*.code.distinct" => "[STT :position] : Mã Hàng nhập đang bị trùng nhau",
          "goods.*.name.required" => "[STT :position] : Hoa chưa nhập Tên Hàng",
          "goods.*.name.unique" => "[STT :position] : Tên Hàng này đã có",
          "goods.*.name.distinct" => "[STT :position] : Tên Hàng nhập đang bị trùng nhau",
          "goods.*.unit_of_good_id.required" => "[STT :position] : Hoa chưa chọn ĐVT",
          "goods.*.unit_of_good_id.exists" => "[STT :position] : ĐVT này hiện tại chưa có",
        ];
    }
}
