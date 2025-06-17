@extends('admin.layout.layout')
@section('title', 'Sửa Thể loại')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa Thể loại</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin Thể loại</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->C_ID) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="C_NAME">Tên Thể loại</label>
                        <input type="text" class="form-control" id="C_NAME" name="C_NAME"
                               value="{{ old('C_NAME', $category->C_NAME) }}" required>
                        @error('C_NAME')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="C_DESCRIPTION">Mô tả Thể loại</label>
                        <input type="text" class="form-control" id="C_DESCRIPTION" name="C_DESCRIPTION"
                               value="{{ old('C_DESCRIPTION', $category->C_DESCRIPTION) }}" required>
                        @error('C_DESCRIPTION')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Sửa Thể loại</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
