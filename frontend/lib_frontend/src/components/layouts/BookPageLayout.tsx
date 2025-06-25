import { Outlet } from 'react-router-dom';

const BooksPageLayout = () => {
  return (
    <div className="books-container flex flex-col w-full h-full">
      <div className="content-area">
        <Outlet /> {/* Đây là nơi BookList hoặc BookDetail sẽ render */}
      </div>
    </div>
  );
};

export default BooksPageLayout;