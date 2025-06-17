<?php
namespace App\FormRequest\Book;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Hoặc logic xác thực tùy theo yêu cầu của bạn
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'B_TITLE' => 'required|string|max:255',
            'B_PUBLIC_DATE' => 'required|date',
            'B_TOTAL_COPIES' => 'required|integer|min:0',
            'B_AVAILABLE_COPIES' => 'required|integer|min:0',
            'B_RATE' => 'nullable|numeric|min:0|max:5',
            'B_TOTAL_READ' => 'nullable|integer|min:0',
            'B_IMAGE' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Tùy chỉnh kích thước tối đa theo yêu cầu
            'C_ID' => 'required|exists:categories,C_ID',
            'A_ID' => 'required|exists:authors,A_ID',
            'P_ID' => 'required|exists:publishers,P_ID',
        ];
    }
    public function messages()
    {
        return [
            'B_TITLE.required' => 'Tiêu đề sách là bắt buộc.',
            'B_TITLE.string' => 'Tiêu đề sách phải là một chuỗi.',
            'B_TITLE.max' => 'Tiêu đề sách không được vượt quá 255 ký tự.',
            'B_PUBLIC_DATE.required' => 'Ngày xuất bản là bắt buộc.',
            'B_PUBLIC_DATE.date' => 'Ngày xuất bản phải là một ngày hợp lệ.',
            'B_TOTAL_COPIES.required' => 'Tổng số bản sao là bắt buộc.',
            'B_TOTAL_COPIES.integer' => 'Tổng số bản sao phải là một số nguyên.',
            'B_TOTAL_COPIES.min' => 'Tổng số bản sao không được nhỏ hơn 0.',
            'B_IMAGE.image' => 'Ảnh sách phải là một tệp hình ảnh.',
            'B_IMAGE.mimes' => 'Ảnh sách phải có định dạng jpeg, png, jpg, gif hoặc svg.',
            'B_AVAILABLE_COPIES.required' => 'Số bản sao có sẵn là bắt buộc.',
            'B_AVAILABLE_COPIES.integer' => 'Số bản sao có sẵn phải là một số nguyên.',
            'B_AVAILABLE_COPIES.min' => 'Số bản sao có sẵn không được nhỏ hơn 0.',
            'B_RATE.numeric' => 'Đánh giá sách phải là một số.',
            'B_RATE.min' => 'Đánh giá sách không được nhỏ hơn 0.',
            'B_RATE.max' => 'Đánh giá sách không được lớn hơn 5.',
            'B_TOTAL_READ.integer' => 'Tổng số lượt đọc phải là một số nguyên.',
            'B_TOTAL_READ.min' => 'Tổng số lượt đọc không được nhỏ hơn 0.',
            'C_ID.required' => 'Danh mục sách là bắt buộc.',
            'C_ID.exists' => 'Danh mục sách không tồn tại.',
            'A_ID.required' => 'Tác giả sách là bắt buộc.',
            'A_ID.exists' => 'Tác giả sách không tồn tại.',
            'P_ID.required' => 'Nhà xuất bản sách là bắt buộc.',
            'P_ID.exists' => 'Nhà xuất bản sách không tồn tại.'
        ];
    }
}
