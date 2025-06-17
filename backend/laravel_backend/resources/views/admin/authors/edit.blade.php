@extends('admin.layout.layout')
@section('title', 'Sửa tác giả')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa tác giả</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin tác giả</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.authors.update', $author->A_ID) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="A_NAME">Tên tác giả</label>
                        <input type="text" class="form-control" id="A_NAME" name="A_NAME"
                               value="{{ old('A_NAME', $author->A_NAME) }}" required>
                        @error('A_NAME')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="A_DESCRIPTION">Mô tả tác giả</label>
                        <input type="text" class="form-control" id="A_DESCRIPTION" name="A_DESCRIPTION"
                               value="{{ old('A_DESCRIPTION', $author->A_DESCRIPTION) }}" required>
                        @error('A_DESCRIPTION')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Sửa tác giả</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
