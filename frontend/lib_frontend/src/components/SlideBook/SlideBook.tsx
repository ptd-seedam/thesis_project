import React from 'react';
import type { Book } from '../../types/Book';
import { Link } from 'react-router-dom';
import { useRecentBooks } from '../../hooks/UseRecentBooks'; // Ensure this hook is correctly implemented

interface SlideBookProps {
  books: Book[];
  title: string;
}

const SlideBook: React.FC<SlideBookProps> = ({ books, title }) => {
  const { addBookId } = useRecentBooks(); // Assuming this hook exists and works as expected

  return (
    <div className=" px-4 py-2 mt-8"> {/* Adjusted margin-top for spacing */}
      <h2 className="text-2xl font-bold mb-4 text-gray-800">{title}</h2> {/* Larger title, more margin */}
      <div className="flex overflow-x-auto space-x-4 pb-4 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
        {/* Added custom scrollbar styles for better UX if needed and configured in Tailwind */}
        {books.map((book) => (
          <Link
            key={book.B_ID} // Key on the outermost element for lists
            to={`/books/${book.B_ID}`}
            onClick={() => addBookId(book.B_ID)}
            className="flex-shrink-0 block" // Make the entire Link a block-level clickable area
          >
            <div
              className="min-w-[200px] max-w-[200px] h-full bg-white shadow rounded p-4 flex flex-col will-change-scroll transition-shadow duration-300 hover:shadow-lg"
              // Removed redundant key, added h-full, flex-col for consistent card height and layout
              // Added hover effect for better user feedback
            >
              <img
                src={book.B_IMAGE || '/default-book.jpg'}
                alt={`Bìa sách của ${book.B_TITLE}`} // Improved alt text for accessibility
                className="w-full h-40 object-cover rounded mb-3" // Slightly more margin below image
              />
              <h3 className="font-semibold text-base text-gray-900 line-clamp-2 mb-1">{book.B_TITLE}</h3> {/* Better text styling */}
              <p className="text-sm text-gray-600 line-clamp-1">{book.author?.A_NAME || 'Đang cập nhật'}</p> {/* Fallback text */}
              <p className="text-sm text-gray-600 line-clamp-1">{book.category?.C_NAME || 'Đang cập nhật'}</p> {/* Fallback text */}
            </div>
          </Link>
        ))}
      </div>
    </div>
  );
};

export default SlideBook;