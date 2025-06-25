import type { Book } from "../types/Book";
import { useEffect, useState } from "react";
import { getBooksRandom } from "../services/bookService";
import { getBookPrediction } from "../services/predictService";
import Cookies from 'js-cookie';

export const SlideBookHook = () => {
    const [books, setBooks] = useState<Book[]>([]);
    const [booksPredict, setBooksPredict] = useState<Book[]>([]);
    const [loading, setLoading] = useState({ random: false, predict: false });

    useEffect(() => {
        const fetchBooks = async () => {
            setLoading((prev) => ({ ...prev, random: true }));
            try {
                const response = await getBooksRandom();
                setBooks(response.data);
            } catch (error) {
                console.error('Lỗi khi lấy sách ngẫu nhiên:', error);
            } finally {
                setLoading((prev) => ({ ...prev, random: false }));
            }
        };

        fetchBooks();
    }, []);

    useEffect(() => {
        const fetchPredictedBooks = async () => {
            setLoading((prev) => ({ ...prev, predict: true }));
            try {
                const cookie = Cookies.get('recent_books');
                const recentBooks: number[] = cookie ? JSON.parse(cookie).map(Number) : [];

            if (!Array.isArray(recentBooks)) {
                console.warn('recent_books không phải là mảng');
                return;
            }

            if (recentBooks.length === 0) {
                console.log('Không có sách gần đây → không gọi API');
                return;
            }
                if (!Array.isArray(recentBooks) || recentBooks.length === 0) return;

                const response = await getBookPrediction({ book_ids: recentBooks });
                setBooksPredict(response.data.data);
                console.log('Sách gợi ý:', response.data);
            } catch (error) {
                console.error('Lỗi khi lấy sách gợi ý:', error);
            } finally {
                setLoading((prev) => ({ ...prev, predict: false }));
            }
        };

        fetchPredictedBooks();
    }, []);

    return {
        books,
        booksPredict,
        loading,
    };
};
