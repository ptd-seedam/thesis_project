import axios from 'axios';
import type { Book } from '../types/Book';
import type { AxiosResponse } from 'axios';

const API_BASE = 'http://localhost:8000/api/user/books/search';

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
    const response: AxiosResponse<SearchResponse> = await axios.get(`${API_BASE}/`, {
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
    const response = await axios.get(`${API_BASE}/${id}`);
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
      `${API_BASE}/author/${authorId}`
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
      `${API_BASE}/category/${categoryId}`
    );
    return response.data;
  } catch (error) {
    console.error('Lỗi khi lấy sách theo thể loại:', error);
    throw error;
  }
};
