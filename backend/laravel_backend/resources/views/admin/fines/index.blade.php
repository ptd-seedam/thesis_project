@extends('admin.layout.layout')
@section('title', 'Danh sách Khoản Phạt')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Danh sách Khoản Phạt</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            @if ($fines->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>Người bị phạt</th>
                                <th>Sách mượn</th>
                                <th>Lý do</th>
                                <th>Số tiền (VNĐ)</th>
                                <th>Ngày lập phạt</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Người bị phạt</th>
                                <th>Sách mượn</th>
                                <th>Lý do</th>
                                <th>Số tiền (VNĐ)</th>
                                <th>Ngày lập phạt</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($fines as $fine)
                                <tr>
                                    <td>{{ $fine->user->U_NAME ?? 'N/A' }}</td>
                                    <td>{{ $fine->borrowing->book->B_TITLE ?? 'N/A' }}</td>
                                    <td>{{ $fine->F_REASON }}</td>
                                    <td>{{ number_format($fine->F_AMOUNT, 0, ',', '.') }}</td>
                                    <td>{{ $fine->F_ISSUED_DATE->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($fine->F_PAID_STATUS)
                                            <span class="badge badge-success">Đã thanh toán</span>
                                        @else
                                            <span class="badge badge-warning">Chưa thanh toán</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.fines.edit', $fine->F_ID) }}" class="btn btn-sm btn-primary">Sửa</a>
                                        <form action="{{ route('admin.fines.destroy', $fine->F_ID) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa khoản phạt này?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>Không có khoản phạt nào.</p>
            @endif
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection
