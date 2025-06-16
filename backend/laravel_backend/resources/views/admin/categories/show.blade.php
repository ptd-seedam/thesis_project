@extends('admin.layout.layout')
@section('title', 'Xem Thể loại')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Xem Thể loại</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin Thể loại</h6>
            </div>
            <div class="card-body">
                <form  enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="A_NAME">Tên Thể loại</label>
                        <input type="text" class="form-control" id="A_NAME" name="C_NAME" value="{{ $category->A_NAME }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="A_DESCRIPTION">Mô tả Thể loại</label>
                        <input type="text" class="form-control" id="A_DESCRIPTION" name="C_DESCRIPTION" value="{{ $category->A_DESCRIPTION }}"  @readonly(true)>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
