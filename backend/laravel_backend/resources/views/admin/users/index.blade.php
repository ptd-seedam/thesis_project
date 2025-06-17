@extends('admin.layout.layout')
@section('title', 'Danh sách người dùng')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách người dùng</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

            </div>
            @if ($users->count() > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Đại chỉ</th>
                                    <th>Quyền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Email</th>
                                    <th>Tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Đại chỉ</th>
                                    <th>Quyền</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->U_NAME }}</td>
                                        <td>{{ $user->U_PHONE }}</td>
                                        <td>{{ $user->U_ADDRESS }}</td>
                                        <td>{{$user->U_ROLE}}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user->U_ID) }}"
                                                class="btn btn-primary btn-sm">Sửa</a>
                                            <form action="{{ route('admin.users.destroy', $user->U_ID) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                            </form>
                                        </td>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card-body">
                    <p>Không có Người dùng nào.</p>
                </div>
            @endif
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
