@extends('admin.layout.layout')
@section('title', 'Tạo Đơn mượn Mới')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tạo Đơn mượn mới</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin Đơn mượn</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.borrowings.store') }}" method="POST">
                @csrf

                {{-- Người mượn --}}
                <div class="form-group">
                    <label for="U_ID">Người mượn</label>
                    <select name="U_ID" id="U_ID" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{ $user->U_ID }}" {{ old('U_ID') == $user->U_ID ? 'selected' : '' }}>
                                {{ $user->U_NAME }}
                            </option>
                        @endforeach
                    </select>
                    @error('U_ID')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sách mượn --}}
                <div class="form-group">
                    <label for="B_ID">Sách mượn</label>
                    <select name="B_ID" id="B_ID" class="form-control">
                        @foreach ($books as $book)
                            <option value="{{ $book->B_ID }}" {{ old('B_ID') == $book->B_ID ? 'selected' : '' }}>
                                {{ $book->B_TITLE }}
                            </option>
                        @endforeach
                    </select>
                    @error('B_ID')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Ngày mượn --}}
                <div class="form-group">
                    <label for="BR_DATE">Ngày mượn</label>
                    <input type="date" class="form-control" id="BR_DATE" name="BR_DATE"
                           value="{{ old('BR_DATE', $defaultValues['BR_DATE'] ?? now()->format('Y-m-d')) }}" required>
                    @error('BR_DATE')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Ngày hết hạn --}}
                <div class="form-group">
                    <label for="BR_DUE_DATE">Ngày hết hạn</label>
                    <input type="date" class="form-control" id="BR_DUE_DATE" name="BR_DUE_DATE"
                           value="{{ old('BR_DUE_DATE', $defaultValues['BR_DUE_DATE'] ?? now()->addWeek()->format('Y-m-d')) }}" required>
                    @error('BR_DUE_DATE')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Ngày trả thực tế (nếu có) --}}
                <div class="form-group">
                    <label for="BR_RETURN_DATE">Ngày trả thực tế (nếu có)</label>
                    <input type="date" class="form-control" id="BR_RETURN_DATE" name="BR_RETURN_DATE"
                           value="{{ old('BR_RETURN_DATE') }}">
                    @error('BR_RETURN_DATE')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Trạng thái --}}
                <div class="form-group">
                    <label for="BR_STATUS">Trạng thái</label>
                    <select name="BR_STATUS" id="BR_STATUS" class="form-control">
                        <option value="Đang mượn" {{ old('BR_STATUS') == 'Đang mượn' ? 'selected' : '' }}>Đang mượn</option>
                        <option value="Đã trả" {{ old('BR_STATUS') == 'Đã trả' ? 'selected' : '' }}>Đã trả</option>
                        <option value="Quá hạn" {{ old('BR_STATUS') == 'Quá hạn' ? 'selected' : '' }}>Quá hạn</option>
                    </select>
                    @error('BR_STATUS')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nút submit --}}
                <button type="submit" class="btn btn-primary">Tạo Đơn mượn</button>
            </form>
        </div>
    </div>
</div>

@endsection
