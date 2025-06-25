import React, { useState } from 'react';
import CategoryDropdown from './CategoryDropdown';
import AuthorDropdown from './AuthorDropdown';
import { AsideHook } from '../../hooks/AsideHook';
import { searchBooks } from '../../services/searchService';

const NavBar: React.FC = () => {
  const { categories, authors, isLoading } = AsideHook();

  const [keyword, setKeyword] = useState('');

  const handleSearch = async () => {
    if (!keyword.trim()) return;

    try {
      const response = await searchBooks({ keyword });
      console.log('Kết quả tìm kiếm:', response.data);
    } catch (error) {
      console.error('Lỗi khi tìm kiếm:', error);
    }
  };

  const handleKeyPress = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key === 'Enter') {
      handleSearch();
    }
  };

  return (
    <nav className="w-full items-center flex justify-between bg-blue-100 p-4" style={{ color: '#060E26' }}>
      <div className='flex justify-between items-center w-full max-w-6xl mx-auto'>
        <div className="flex items-center h-auto">
          <h2 className="text-xl font-bold">Nhà sách nụ cười</h2>
        </div>

        <div className="flex items-center space-x-2">
          <input
            type="text"
            placeholder="Tìm kiếm sách, tác giả..."
            value={keyword}
            onChange={(e) => {
              setKeyword(e.target.value);
              handleSearch();
            }}
            onKeyDown={handleKeyPress}
            className="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
        <div className='flex flex-row items-center '>
          <div>
            <CategoryDropdown
              categories={categories}
              isLoading={isLoading}
              onSelectCategory={(cat) => console.log('Chọn thể loại:', cat)}
            />
          </div>
          <div className="ml-4">
            <AuthorDropdown
              author={authors}
              isLoading={isLoading}
              onSelectCategory={(author) => console.log('Chọn tác giả:', author)}
            />
          </div>
          <div className="flex items-center space-x-4 ml-4">
            <button className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
              Đăng nhập
            </button>
          </div>
        </div>
      </div>
    </nav>
  );
};

export default NavBar;
