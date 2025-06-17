@extends('admin.layout.layout')
@section('title', 'Tạo thể loại')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tạo thể loại</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin thể loại</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="C_NAME">Tên thể loại</label>
                        <input type="text" class="form-control" id="C_NAME" name="C_NAME" required>
                    </div>
                    @error('C_NAME')
                        <div class="alert alert-danger">{{ $message }}</div>

                    @enderror
                    <div class="form-group">
                        <label for="A_DESCRIPTION">Mô tả thể loại</label>
                        <input type="text" class="form-control" id="C_DESCRIPTION" name="C_DESCRIPTION" required>
                    </div>
                    @error('C_DESCRIPTION')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Tạo thể loại</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
