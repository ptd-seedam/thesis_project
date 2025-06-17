@extends('admin.layout.layout')
@section('title', 'Xem tác giả')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Xem tác giả</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin tác giả</h6>
            </div>
            <div class="card-body">
                <form  enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="A_NAME">Tên tác giả</label>
                        <input type="text" class="form-control" id="A_NAME" name="A_NAME" value="{{ $author->A_NAME }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="A_DESCRIPTION">Mô tả tác giả</label>
                        <input type="text" class="form-control" id="A_DESCRIPTION" name="A_DESCRIPTION" value="{{ $author->A_DESCRIPTION }}"  @readonly(true)>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
