import { useParams, Link } from 'react-router-dom';
import { useBookDetail } from '../hooks/BookHook';
import { SlideBookHook } from '../hooks/SlideBookHook';
import SlideBook from '../components/SlideBook/SlideBook';
import BorrowButton from '../components/Button/BorrowButton';

function BookDetail() {
  const bookId = Number(useParams().bookId);
  const { book, isLoading, error } = useBookDetail(bookId);
  const { booksPredict } = SlideBookHook();

  return (
    <div className="min-h-screen bg-gray-50 py-8 px-4">
      <div className="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div className="p-8">
          <div className="flex justify-between items-start mb-6">
            <h1 className="text-3xl font-bold text-gray-800">Chi tiết sách</h1>
            <Link to="/books" className="text-blue-600 hover:text-blue-800 transition-colors">
              ← Quay lại
            </Link>
          </div>

          {isLoading && (
            <div className="text-center py-12">
              <div className="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500 mb-4 mx-auto"></div>
              <p className="text-lg text-gray-600">Đang tải thông tin sách...</p>
            </div>
          )}

          {error && (
            <div className="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
              <p>{error}</p>
            </div>
          )}

          {!isLoading && book && (
            <div className="flex flex-col md:flex-row gap-8">
              <div className="md:w-1/3 flex flex-col items-center">
                <img
                  src={book.B_IMAGE || '/default-book.jpg'}
                  alt={book.B_TITLE}
                  className="w-full max-w-xs h-auto rounded-lg shadow-lg object-cover mb-4"
                />
              </div>

              <div className="md:w-2/3">
                <h2 className="text-2xl font-semibold text-gray-800 mb-4">{book.B_TITLE}</h2>

                <div className="bg-blue-50 p-4 rounded-lg mb-6">
                  <span className="text-gray-500">•</span>{' '}
                  <span>{Number(book.B_TOTAL_READ).toLocaleString() || '0'} lượt đọc</span>
                </div>

                <div className="space-y-4">
                  <InfoRow label="Tác giả" value={book.author?.A_NAME} />
                  <InfoRow label="Thể loại" value={book.category?.C_NAME} />
                  <InfoRow label="Nhà xuất bản" value={book.publisher?.P_NAME} />
                  <InfoRow
                    label="Ngày xuất bản"
                    value={
                      book.B_PUBLIC_DATE
                        ? new Date(book.B_PUBLIC_DATE).toLocaleDateString('vi-VN')
                        : 'Đang cập nhật'
                    }
                  />
                  <InfoRow
                    label="Số bản có sẵn"
                    value={`${Number(book.B_AVAILABLE_COPIES).toLocaleString()} / ${Number(
                      book.B_TOTAL_COPIES
                    ).toLocaleString()}`}
                    valueClass={
                      book.B_AVAILABLE_COPIES > 0 ? 'text-green-600' : 'text-red-600'
                    }
                  />

                  {/* 👉 Gọi BorrowButton */}
                  <BorrowButton
                    bookId={book.B_ID}
                    availableCopies={book.B_AVAILABLE_COPIES}
                  />
                </div>
              </div>
            </div>
          )}
        </div>
      </div>

      {/* Gợi ý */}
      <div className="max-w-4xl mx-auto mt-12">
        <SlideBook title="Sách gợi ý cho bạn" books={booksPredict} />
      </div>
    </div>
  );
}

const InfoRow = ({
  label,
  value,
  valueClass = 'text-gray-800',
}: {
  label: string;
  value: string;
  valueClass?: string;
}) => (
  <div className="flex flex-wrap">
    <span className="text-gray-600 font-medium w-32">{label}:</span>
    <span className={`flex-1 ${valueClass}`}>{value || 'Đang cập nhật'}</span>
  </div>
);

export default BookDetail;
