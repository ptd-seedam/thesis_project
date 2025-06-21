import { useEffect, useState } from 'react';
import { getCategories } from '../services/categoryService';
import { getAuthors } from '../services/authorService'; // bạn cần tạo file này
import type { Category } from '../types/Category';
import type { Author } from '../types/Author';

export const AsideHook = () => {
  const [categories, setCategories] = useState<Category[]>([]);
  const [authors, setAuthors] = useState<Author[]>([]);
  const [isLoading, setIsLoading] = useState(false);

  useEffect(() => {
    const fetchData = async () => {
      setIsLoading(true);
      try {
        const [categoryRes, authorRes] = await Promise.all([
          getCategories(),
          getAuthors()
        ]);
        setCategories(categoryRes.data || []);
        setAuthors(authorRes.data || []);
      } catch (error) {
        console.error('Error fetching data:', error);
      } finally {
        setIsLoading(false);
      }
    };

    fetchData();
  }, []);

  return { categories, authors, isLoading };
};
