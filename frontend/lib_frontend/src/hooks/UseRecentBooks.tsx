import { useCallback } from 'react';
import Cookies from 'js-cookie';

const COOKIE_NAME = 'recent_books';
const MAX_ITEMS = 10;

export const useRecentBooks = () => {
  const getRecentBookIds = useCallback((): number[] => {
    const cookie = Cookies.get(COOKIE_NAME);
    try {
      return cookie ? JSON.parse(cookie) : [];
    } catch {
      return [];
    }
  }, []);

  const addBookId = useCallback((bookId: number) => {
    let ids: number[] = getRecentBookIds();

    ids = ids.filter(id => id !== bookId);

    ids.unshift(bookId);

    if (ids.length > MAX_ITEMS) {
      ids = ids.slice(0, MAX_ITEMS);
    }

    Cookies.set(COOKIE_NAME, JSON.stringify(ids), { expires: 7 });
  }, [getRecentBookIds]);

  return { getRecentBookIds, addBookId };
};
