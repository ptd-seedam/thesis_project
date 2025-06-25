import { getBookDetail } from "../services/bookService";
import { useEffect, useState } from "react";
import type { Book } from "../types/Book";

export const useBookDetail = (bookId: number) => {
  const [book, setBook] = useState<Book | null>(null);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchBookDetail = async () => {
      try {
        setIsLoading(true);
        const response = await getBookDetail(bookId);
        if (response.data) {
          setBook(response.data);
        } else {
          setError("Không tìm thấy sách");
        }
      } catch (err) {
        console.error("Error fetching book detail:", err);
        setError("Failed to fetch book details");
      } finally {
        setIsLoading(false);
      }
    };

    fetchBookDetail();
  }, [bookId]);

  return { book, isLoading, error };
};