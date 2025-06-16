<?php
namespace App\FormRequest\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'U_NAME' => 'required|string|max:255',
            'U_PHONE' => 'nullable|string|max:20',
            'U_ADDRESS' => 'nullable|string|max:255',
            'U_ROLE' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'U_NAME.required' => 'Tên người dùng là bắt buộc.',
            'U_NAME.string' => 'Tên người dùng phải là một chuỗi.',
            'U_NAME.max' => 'Tên người dùng không được vượt quá 255 ký tự.',
            'U_PHONE.string' => 'Số điện thoại phải là một chuỗi.',
            'U_PHONE.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'U_ADDRESS.string' => 'Địa chỉ phải là một chuỗi.',
            'U_ADDRESS.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'U_ROLE.required' => 'Vai trò người dùng là bắt buộc.',
            'U_ROLE.string' => 'Vai trò người dùng phải là một số nguyên.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email phải là một địa chỉ email hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ];
    }
}
