import axios from 'axios';

export const getBooks = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/user/books');
    return response.data;
  } catch (error) {
    console.error('Lỗi khi tải sách:', error);
    return [];
  }
}
export const getBooksRandom = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/user/books/random');
    return response.data;
  } catch (error) {
    console.error('Lỗi khi tải sách ngẫu nhiên:', error);
    return [];
  }
}
export const getBookDetail = async (id: number) => {
  try {
    const response = await axios.get(`http://localhost:8000/api/user/books/${id}`);
    return response.data;
  } catch (error) {
    console.error('Lỗi khi tải chi tiết sách:', error);
    return null;
  }
}
