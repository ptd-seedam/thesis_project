@extends('admin.layout.layout')
@section('title', 'Tạo Nhà xuất bản')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tạo Nhà xuất bản</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin Nhà xuất bản</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.publishers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="A_NAME">Tên Nhà xuất bản</label>
                        <input type="text" class="form-control" id="A_NAME" name="P_NAME" required>
                    </div>
                    @error('A_NAME')
                        <div class="alert alert-danger">{{ $message }}</div>

                    @enderror
                    <div class="form-group">
                        <label for="A_DESCRIPTION">Địa chỉ Nhà xuất bản</label>
                        <input type="text" class="form-control" id="A_DESCRIPTION" name="P_ADDRESS" required>
                    </div>
                    @error('B_PUBLIC_DATE')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Tạo Nhà xuất bản</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
