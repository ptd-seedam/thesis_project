<?php
namespace App\FormRequest\Fine;
use Illuminate\Foundation\Http\FormRequest;

class FineRequest extends FormRequest
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
            'F_AMOUNT' => 'required|numeric|min:0',
            'F_REASON' => 'required|string|max:255',
            'F_ISSUED_DATE' => 'required|date',
            'F_PAID_STATUS' => 'required|boolean',
            'U_ID' => 'required|exists:users,U_ID',
            'BR_ID' => 'required|exists:borrowings,BR_ID',
        ];
    }
    public function messages()
    {
        return [
            'F_AMOUNT.required' => 'Số tiền phạt là bắt buộc.',
            'F_AMOUNT.numeric' => 'Số tiền phạt phải là một số.',
            'F_AMOUNT.min' => 'Số tiền phạt phải lớn hơn hoặc bằng 0.',
            'F_REASON.required' => 'Lý do phạt là bắt buộc.',
            'F_REASON.string' => 'Lý do phạt phải là một chuỗi.',
            'F_REASON.max' => 'Lý do phạt không được vượt quá 255 ký tự.',
            'F_ISSUED_DATE.required' => 'Ngày phát hành là bắt buộc.',
            'F_ISSUED_DATE.date' => 'Ngày phát hành phải là một ngày hợp lệ.',
            'F_PAID_STATUS.required' => 'Trạng thái đã thanh toán là bắt buộc.',
            'F_PAID_STATUS.boolean' => 'Trạng thái đã thanh toán phải là true hoặc false.',
            'U_ID.required' => 'ID người dùng là bắt buộc.',
            'U_ID.exists' => 'Người dùng không tồn tại.',
            'BR_ID.required' => 'ID lượt mượn là bắt buộc.',
            'BR_ID.exists' => 'Lượt mượn không tồn tại.',
        ];
    }
}
