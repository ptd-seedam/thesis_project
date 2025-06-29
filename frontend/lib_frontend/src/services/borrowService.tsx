import axios from 'axios';
import type { Borrowing } from '../types/Borrowing';

export const storeBorrowing = async (data: Borrowing) => {
  try {
    const response = await axios.post('http://localhost:8000/api/borrowing', data, {
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${localStorage.getItem('authToken')}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error('Lỗi khi lưu mượn sách:', error);
    throw error;
  }
}