<?php

namespace App\Http\Controllers\Api;

use App\FormRequest\AuthRequest;
use App\FormRequest\User\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::created($data);
        if (! $user) {
            return response()->json(['error' => 'Tạo tài khoản thất bại'], 500);
        }

        return response()->json([
            'message' => 'Tạo tài khoản thành công',
            'user' => $user,
        ], 201);
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::guard('api')->user();

        return response()->json([
            'message' => 'Đăng nhập thành công',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            Auth::logout();

            return response()->json(['message' => 'Đăng xuất thành công']);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function profile()
    {
        $user = Auth::user();
        if ($user) {
            return response()->json([
                'message' => 'Lấy thông tin người dùng thành công',
                'user' => $user,
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
