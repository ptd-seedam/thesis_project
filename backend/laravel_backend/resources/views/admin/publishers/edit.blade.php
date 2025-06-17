@extends('admin.layout.layout')
@section('title', 'Sửa Nhà xuất bản')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa Nhà xuất bản</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin Nhà xuất bản</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.publishers.update', $publisher->P_ID) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="p_NAME">Tên Nhà xuất bản</label>
                        <input type="text" class="form-control" id="A_NAME" name="P_NAME"
                               value="{{ old('P_NAME', $publisher->P_NAME) }}" required>
                        @error('P_NAME')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="P_ADDRESS">Mô tả Nhà xuất bản</label>
                        <input type="text" class="form-control" id="A_DESCRIPTION" name="P_ADDRESS"
                               value="{{ old('P_ADDRESS', $publisher->P_ADDRESS) }}" required>
                        @error('P_ADDRESS')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Sửa Nhà xuất bản</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
