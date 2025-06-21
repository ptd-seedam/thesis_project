import axios from 'axios';

export const getAuthors = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/user/authors');
    return response.data;
  } catch (error) {
    console.error('Lỗi khi tải tác giả:', error);
    return [];
  }
};
