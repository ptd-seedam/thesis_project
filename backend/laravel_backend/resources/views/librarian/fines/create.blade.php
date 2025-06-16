@extends('librarian.layout.layout')
@section('title', 'Thêm Đơn Phạt')
@section('content')

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Thêm Đơn Phạt</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin Đơn Phạt</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('librarian.fines.store') }}" method="POST">
                @csrf

                {{-- Người bị phạt --}}
                <div class="form-group">
                    <label for="U_ID">Người bị phạt</label>
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

                {{-- Lượt mượn liên quan --}}
                <div class="form-group">
                    <label for="BR_ID">Lượt mượn</label>
                    <select name="BR_ID" id="BR_ID" class="form-control">
                        @foreach ($borrowings as $borrowing)
                            <option value="{{ $borrowing->BR_ID }}" {{ old('BR_ID') == $borrowing->BR_ID ? 'selected' : '' }}>
                                #{{ $borrowing->BR_ID }} - {{ $borrowing->user->U_NAME }} - {{ $borrowing->book->B_TITLE }}
                            </option>
                        @endforeach
                    </select>
                    @error('BR_ID')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Lý do phạt --}}
                <div class="form-group">
                    <label for="F_REASON">Lý do phạt</label>
                    <textarea name="F_REASON" id="F_REASON" class="form-control" rows="3">{{ old('F_REASON') }}</textarea>
                    @error('F_REASON')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Số tiền phạt --}}
                <div class="form-group">
                    <label for="F_AMOUNT">Số tiền phạt (VNĐ)</label>
                    <input type="number" name="F_AMOUNT" id="F_AMOUNT" class="form-control" value="{{ old('F_AMOUNT') }}" required>
                    @error('F_AMOUNT')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Ngày lập đơn --}}
                <div class="form-group">
                    <label for="F_ISSUED_DATE">Ngày lập đơn</label>
                    <input type="date" name="F_ISSUED_DATE" id="F_ISSUED_DATE" class="form-control" value="{{ old('F_ISSUED_DATE', now()->format('Y-m-d')) }}" required>
                    @error('F_ISSUED_DATE')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Trạng thái thanh toán --}}
                <div class="form-group">
                    <label for="F_PAID_STATUS">Trạng thái thanh toán</label>
                    <select name="F_PAID_STATUS" id="F_PAID_STATUS" class="form-control">
                        <option value="0" {{ old('F_PAID_STATUS') == '0' ? 'selected' : '' }}>Chưa thanh toán</option>
                        <option value="1" {{ old('F_PAID_STATUS') == '1' ? 'selected' : '' }}>Đã thanh toán</option>
                    </select>
                    @error('F_PAID_STATUS')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nút submit --}}
                <button type="submit" class="btn btn-primary">Tạo Đơn Phạt</button>
            </form>
        </div>
    </div>
</div>

@endsection
