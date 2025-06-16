@extends('admin.layout.layout')
@section('title', 'Chỉnh sửa Người dùng')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chỉnh sửa Người dùng</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin Người dùng</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->U_ID) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Tên --}}
                <div class="form-group">
                    <label for="U_NAME">Tên người dùng</label>
                    <input type="text" name="U_NAME" id="U_NAME" class="form-control"
                        value="{{ old('U_NAME', $user->U_NAME) }}" required>
                    @error('U_NAME')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Số điện thoại --}}
                <div class="form-group">
                    <label for="U_PHONE">Số điện thoại</label>
                    <input type="text" name="U_PHONE" id="U_PHONE" class="form-control"
                        value="{{ old('U_PHONE', $user->U_PHONE) }}">
                    @error('U_PHONE')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Địa chỉ --}}
                <div class="form-group">
                    <label for="U_ADDRESS">Địa chỉ</label>
                    <input type="text" name="U_ADDRESS" id="U_ADDRESS" class="form-control"
                        value="{{ old('U_ADDRESS', $user->U_ADDRESS) }}">
                    @error('U_ADDRESS')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Vai trò --}}
                <div class="form-group">
                    <label for="U_ROLE">Vai trò</label>
                    <select name="U_ROLE" id="U_ROLE" class="form-control">
                        <option value="admin" {{ old('U_ROLE', $user->U_ROLE) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="librarian" {{ old('U_ROLE', $user->U_ROLE) == 'librarian' ? 'selected' : '' }}>Thủ thư</option>
                        <option value="user" {{ old('U_ROLE', $user->U_ROLE) == 'user' ? 'selected' : '' }}>Người dùng</option>
                    </select>
                    @error('U_ROLE')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Mật khẩu mới --}}
                <div class="form-group">
                    <label for="password">Mật khẩu mới (bỏ trống nếu không đổi)</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Xác nhận mật khẩu --}}
                <div class="form-group">
                    <label for="password_confirmation">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

@endsection
