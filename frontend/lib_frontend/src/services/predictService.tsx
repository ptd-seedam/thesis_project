// services/predictService.ts
import axios from 'axios';

export const getBookPrediction = async (data: { book_ids: number[] }) => {
  return await axios.post('http://localhost:8000/api/user/predict', data);
};
