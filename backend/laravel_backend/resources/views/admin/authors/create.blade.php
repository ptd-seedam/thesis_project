@extends('admin.layout.layout')
@section('title', 'Tạo tác giả')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tạo tác giả</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin tác giả</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.authors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="A_NAME">Tên tác giả</label>
                        <input type="text" class="form-control" id="A_NAME" name="A_NAME" required>
                    </div>
                    @error('A_NAME')
                        <div class="alert alert-danger">{{ $message }}</div>

                    @enderror
                    <div class="form-group">
                        <label for="A_DESCRIPTION">Mô tả tác giả</label>
                        <input type="text" class="form-control" id="A_DESCRIPTION" name="A_DESCRIPTION" required>
                    </div>
                    @error('B_PUBLIC_DATE')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Tạo tác giả</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
