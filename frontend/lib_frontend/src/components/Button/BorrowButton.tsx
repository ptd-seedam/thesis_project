import React from 'react';
import axios from '../../utils/axiosInstance';
import { toast } from 'react-toastify';

interface BorrowButtonProps {
  bookId: number;
  availableCopies: number;
}

const BorrowButton: React.FC<BorrowButtonProps> = ({ bookId, availableCopies }) => {
  const handleBorrow = async () => {
    try {
      const token = localStorage.getItem('authToken');
      if (!token) {
        toast.error('Bạn cần đăng nhập để mượn sách.');
        return;
      }

      const today = new Date();
      const dueDate = new Date(today);
      dueDate.setDate(today.getDate() + 7); // hạn mượn 7 ngày

      const response = await axios.post(
        `/borrow/${bookId}`,
        {
          BR_DATE: today.toISOString(),
          BR_DUE_DATE: dueDate.toISOString(),
        },
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );

      toast.success('🎉 Mượn sách thành công!');
    } catch (err: any) {
      console.error(err);
      const msg =
        err?.response?.data?.error || 'Không thể mượn sách, vui lòng thử lại.';
      toast.error(msg);
    }
  };

  if (availableCopies <= 0) {
    return (
      <button
        className="w-full bg-gray-400 text-white px-4 py-3 rounded-lg cursor-not-allowed font-medium"
        disabled
      >
        Đã hết sách
      </button>
    );
  }

  return (
    <button
      onClick={handleBorrow}
      className="w-full bg-blue-500 text-white text-center px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium"
    >
      Mượn sách ngay
    </button>
  );
};

export default BorrowButton;
