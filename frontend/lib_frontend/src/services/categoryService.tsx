import axios from 'axios';

export const getCategories = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/user/categories');
    return response.data;
  } catch (error) {
    console.error('Lỗi khi tải categories:', error);
    return [];
  }
};
