@extends('admin.layout.layout')
@section('title', 'Danh sách Tác giả')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách Tác giả</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

            </div>
            @if ($authors->count() > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Tên tác giả</th>
                                    <th>Giới thiệu tác giả</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tên tác giả</th>
                                    <th>Giới thiệu tác giả</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($authors as $author)
                                    <tr>
                                        <td>{{ $author->A_NAME }}</td>
                                        <td>{{ $author->A_DESCRIPTION }}</td>

                                        <td>
                                            <a href="{{ route('admin.authors.edit', $author->A_ID) }}"
                                                class="btn btn-primary btn-sm">Sửa</a>
                                            <form action="{{ route('admin.authors.destroy', $author->A_ID) }}" method="POST"
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
                    <p>Không có Tác giả nào.</p>
                </div>
            @endif
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
