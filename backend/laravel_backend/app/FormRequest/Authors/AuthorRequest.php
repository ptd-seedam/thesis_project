<?php
namespace App\FormRequest\Authors;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'A_NAME' => 'required|string|max:255',
            'A_DESCRIPTION' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'A_NAME.required' => 'Tên tác giả là bắt buộc.',
            'A_NAME.string' => 'Tên tác giả phải là một chuỗi.',
            'A_NAME.max' => 'Tên tác giả không được vượt quá 255 ký tự.',
            'A_DESCRIPTION.string' => 'Mô tả tác giả phải là một chuỗi.',
        ];
    }
}
