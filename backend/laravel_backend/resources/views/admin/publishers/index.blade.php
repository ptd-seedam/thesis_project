@extends('admin.layout.layout')
@section('title', 'Danh sách Nhà xuất bản')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách Nhà xuất bản</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

            </div>
            @if ($publishers->count() > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Tên Nhà xuất bản</th>
                                    <th>Giới thiệu Nhà xuất bản</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tên Nhà xuất bản</th>
                                    <th>Giới thiệu Nhà xuất bản</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($publishers as $publisher)
                                    <tr>
                                        <td>{{ $publisher->P_NAME }}</td>
                                        <td>{{ $publisher->P_ADDRESS }}</td>
                                        <td>
                                            <a href="{{ route('admin.publishers.edit', $publisher->P_ID) }}"
                                                class="btn btn-primary btn-sm">Sửa</a>
                                            <form action="{{ route('admin.publishers.destroy', $publisher->P_ID) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                            </form>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card-body">
                    <p>Không có Nhà xuất bản nào.</p>
                </div>
            @endif
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
