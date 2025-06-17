<?php
namespace App\FormRequest\Borrowing;
use Illuminate\Foundation\Http\FormRequest;

class BorrowingRequest extends FormRequest
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
            'BR_DATE' => 'required|date',
            'BR_DUE_DATE' => 'required|date|after_or_equal:BR_DATE',
            'BR_RETURN_DATE' => 'nullable|date|after_or_equal:BR_DATE',
            'BR_STATUS' => 'required|string|max:50',
            'U_ID' => 'required|exists:users,U_ID',
            'B_ID' => 'required|exists:books,B_ID',
        ];
    }
    public function messages()
    {
        return [
            'BR_DATE.required' => 'Ngày mượn là bắt buộc.',
            'BR_DATE.date' => 'Ngày mượn phải là một ngày hợp lệ.',
            'BR_DUE_DATE.required' => 'Ngày trả là bắt buộc.',
            'BR_DUE_DATE.date' => 'Ngày trả phải là một ngày hợp lệ.',
            'BR_DUE_DATE.after_or_equal' => 'Ngày trả phải sau hoặc bằng ngày mượn.',
            'BR_RETURN_DATE.date' => 'Ngày trả thực tế phải là một ngày hợp lệ.',
            'BR_RETURN_DATE.after_or_equal' => 'Ngày trả thực tế phải sau hoặc bằng ngày mượn.',
            'BR_STATUS.required' => 'Trạng thái mượn là bắt buộc.',
            'BR_STATUS.string' => 'Trạng thái mượn phải là một chuỗi.',
            'BR_STATUS.max' => 'Trạng thái mượn không được vượt quá 50 ký tự.',
            'U_ID.required' => 'ID người dùng là bắt buộc.',
            'U_ID.exists' => 'Người dùng không tồn tại.',
            'B_ID.required' => 'ID sách là bắt buộc.',
            'B_ID.exists' => 'Sách không tồn tại.',

        ];
    }
}
