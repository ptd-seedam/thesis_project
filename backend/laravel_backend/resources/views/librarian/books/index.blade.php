@extends('librarian.layout.layout')
@section('title', 'Authors')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách Sách</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

            </div>
            @if ($books->count() > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Ngày xuất bản</th>
                                    <th>Tống số sách</th>
                                    <th>Sách còn trong kho</th>
                                    <th>Lượt đọc</th>
                                    <th>Tác giả</th>
                                    <th>Nhà xuất bản</th>
                                    <th>Thể loại</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Ngày xuất bản</th>
                                    <th>Tống số sách</th>
                                    <th>Sách còn trong kho</th>
                                    <th>Lượt đọc</th>
                                    <th>Tác giả</th>
                                    <th>Nhà xuất bản</th>
                                    <th>Thể loại</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $book->B_TITLE }}</td>
                                        <td>{{ $book->B_PUBLIC_DATE }}</td>
                                        <td>{{ $book->B_TOTAL_COPIES }}</td>
                                        <td>{{ $book->B_AVAILABLE_COPIES }}</td>
                                        <td>{{ $book->B_TOTAL_READ }}</td>
                                        <td>{{ $book->author->A_NAME }}</td>
                                        <td>{{ $book->publisher->P_NAME }}</td>
                                        <td>{{ $book->category->C_NAME }}</td>
                                        <td>
                                            <a href="{{ route('librarian.books.edit', $book->B_ID) }}"
                                                class="btn btn-primary btn-sm">Sửa</a>
                                            <form action="{{ route('librarian.books.destroy', $book->B_ID) }}" method="POST"
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
                    <p>Không có sách nào.</p>
                </div>
            @endif
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
