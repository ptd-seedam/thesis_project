import React from 'react';
import type { Book } from '../../types/Book'; // nếu bạn có type
import { Link } from 'react-router-dom'; // nếu có liên kết chi tiết sách
import { useRecentBooks } from '../../hooks/UseRecentBooks';


interface SlideBookProps {
  books: Book[],
  title: string
}

const SlideBook: React.FC<SlideBookProps> = ({ books, title }) => {
  const { addBookId } = useRecentBooks();
  return (
    <div className="w-[90%] px-4 py-2 m-1 ">
      <h2 className="text-xl font-bold mb-3">{ title }</h2>
      <div className="flex overflow-x-auto space-x-4">
        {books.map((book) => (
          <Link
            key={book.B_ID}
            to={`/books/${book.B_ID}`}
            onClick={() => addBookId(book.B_ID)}
            className="text-blue-500 text-sm mt-2 inline-block"
          >
            <div
              key={book.B_ID}
              className="min-w-[200px] min-h-full max-w-[200px] bg-white shadow rounded p-4 flex-shrink-0 will-change-scroll"
            >
              <img
                src={book.B_IMAGE || '/default-book.jpg'}
                alt={book.B_TITLE}
                className="w-full h-40 object-cover rounded mb-2"
              />
              <h3 className="font-semibold text-sm">{book.B_TITLE}</h3>
              <p className="text-xs text-gray-600">{book.author?.A_NAME}</p>
              <p className="text-xs text-gray-600">{book.category?.C_NAME}</p>

            </div>
          </Link>
        ))}
      </div>
    </div>
  );
};

export default SlideBook;
