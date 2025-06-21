import axios from 'axios';
import type { Book } from '../types/Book'; // bạn cần định nghĩa kiểu dữ liệu
import type { AxiosResponse } from 'axios';

const BASE_URL = 'http://localhost:8000/api/user/books/search'; // chỉnh nếu khác

interface SearchParams {
  keyword: string;
  per_page?: number;
  author_id?: number;
  category_id?: number;
  publisher_id?: number;
  available?: boolean;
  sort_by?: string;
  sort_dir?: 'asc' | 'desc';
}

interface SearchResponse {
  success: boolean;
  data: Book[];
  meta: {
    total: number;
  };
}

export const searchBooks = async (
  params: SearchParams
): Promise<SearchResponse> => {
  try {
    const response: AxiosResponse<SearchResponse> = await axios.get(`${BASE_URL}/search`, {
      params,
    });

    return response.data;
  } catch (error) {
    console.error('Lỗi khi tìm kiếm sách:', error);
    throw error;
  }
};

export const getBookDetail = async (id: number): Promise<Book> => {
  try {
    const response = await axios.get(`${BASE_URL}/${id}`);
    return response.data.data;
  } catch (error) {
    console.error('Lỗi khi lấy chi tiết sách:', error);
    throw error;
  }
};

export const getBooksByAuthor = async (
  authorId: number
): Promise<SearchResponse> => {
  try {
    const response: AxiosResponse<SearchResponse> = await axios.get(
      `${BASE_URL}/author/${authorId}`
    );
    return response.data;
  } catch (error) {
    console.error('Lỗi khi lấy sách theo tác giả:', error);
    throw error;
  }
};

export const getBooksByCategory = async (
  categoryId: number
): Promise<SearchResponse> => {
  try {
    const response: AxiosResponse<SearchResponse> = await axios.get(
      `${BASE_URL}/category/${categoryId}`
    );
    return response.data;
  } catch (error) {
    console.error('Lỗi khi lấy sách theo thể loại:', error);
    throw error;
  }
};
