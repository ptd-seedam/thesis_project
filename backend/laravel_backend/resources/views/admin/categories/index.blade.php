@extends('admin.layout.layout')
@section('title', 'Danh sách Thể loại')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách Thể loại</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

            </div>
            @if ($categories->count() > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Tên Thể loại</th>
                                    <th>Giới thiệu Thể loại</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tên Thể loại</th>
                                    <th>Giới thiệu Thể loại</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->C_NAME }}</td>
                                        <td>{{ $category->C_DESCRIPTION }}</td>

                                        <td>
                                            <a href="{{ route('admin.categories.edit', $category->C_ID) }}"
                                                class="btn btn-primary btn-sm">Sửa</a>
                                            <form action="{{ route('admin.categories.destroy', $category->C_ID) }}" method="POST"
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
                    <p>Không có Thể loại nào.</p>
                </div>
            @endif
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
