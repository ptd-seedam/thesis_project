<?php

namespace App\Http\Controllers\Admin;

use App\FormRequest\User\CreateUserRequest;
use App\Http\Controllers\Controller;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            abort(404);
        }
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();

        // Hash password before create
        $data['password'] = bcrypt($data['password']);

        if ($this->userService->getUserByEmail($data['email'])) {
            return redirect()->back()->withErrors(['email' => 'Email đã tồn tại'])->withInput();
        }

        $this->userService->createUser($data);

        return redirect()->route('admin.users.index')->with('success', 'Tạo người dùng thành công');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            abort(404);
        }
        return view('admin.users.edit', compact('user'));
    }

    public function update(CreateUserRequest $request, $id)
    {
        $data = $request->validated();

        // Nếu có password mới thì hash
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // Không cập nhật mật khẩu
        }

        $this->userService->updateUser($id, $data);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công');
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công');
    }
}
