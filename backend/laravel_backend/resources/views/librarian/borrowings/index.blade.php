@extends('librarian.layout.layout')
@section('title', 'Đơn mượn Sách')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh sách Sách</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

            </div>
            @if ($borrowings->count() > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Người mượn sách</th>
                                    <th>Tên Sách</th>
                                    <th>Ngày mượn</th>
                                    <th>Này hết hạn</th>
                                    <th>Ngày trả</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Người mượn sách</th>
                                    <th>Tên Sách</th>
                                    <th>Ngày mượn</th>
                                    <th>Này hết hạn</th>
                                    <th>Ngày trả</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($borrowings as $borrowing)
                                    <tr>
                                        <td>{{ $borrowing->user->U_NAME }}</td>
                                        <td>{{ $borrowing->book->B_TITLE }}t</td>
                                        <td>{{ $borrowing->BR_DATE }}</td>
                                        <td>{{ $borrowing->BR_DUE_DATE }}</td>
                                        <td>{{ $borrowing->BR_RETURN_DATE }}</td>
                                        <td>{{ $borrowing->BR_STATUS }}</td>

                                        <td>
                                            <a href="{{ route('librarian.borrowings.edit', $borrowing->BR_ID) }}"
                                                class="btn btn-primary btn-sm">Sửa</a>
                                            <form action="{{ route('librarian.borrowings.destroy', $borrowing->BR_ID) }}" method="POST"
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
