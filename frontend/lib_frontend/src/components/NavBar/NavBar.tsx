import React, { useState } from 'react';
import CategoryDropdown from './CategoryDropdown';
import AuthorDropdown from './AuthorDropdown';
import { AsideHook } from '../../hooks/AsideHook';
import { searchBooks } from '../../services/searchService';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../../hooks/UseAuth';

const NavBar: React.FC = () => {
  const { categories, authors, isLoading } = AsideHook();
  const [keyword, setKeyword] = useState('');
  const { isAuthenticated, user } = useAuth();
  const navigate = useNavigate();

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

  const handleLogout = () => {
    localStorage.removeItem('authToken');
    localStorage.removeItem('user');
    navigate('/login');
  };

  return (
    <nav className="w-full items-center flex justify-between bg-blue-100 p-4 text-black">
      <div className="flex justify-between items-center w-full max-w-6xl mx-auto">
        <Link to={`/`}>
          <h2 className="text-xl font-bold">Nhà sách nụ cười</h2>
        </Link>

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

        <div className="flex flex-row items-center space-x-4">
          <CategoryDropdown
            categories={categories}
            isLoading={isLoading}
            onSelectCategory={(cat) => console.log('Chọn thể loại:', cat)}
          />

          <AuthorDropdown
            author={authors}
            isLoading={isLoading}
            onSelectCategory={(author) => console.log('Chọn tác giả:', author)}
          />

          {!isAuthenticated ? (
            <Link to={`/login`}>
              <button className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Đăng nhập
              </button>
            </Link>
          ) : (
            <div className="relative group">
              <button className="px-4 py-2 rounded">
                {user?.U_NAME || 'Tài khoản'}
              </button>
              <div className="absolute right-0 mt-2 w-40 bg-white rounded shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                <Link
                  to="/profile"
                  className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                  Hồ sơ
                </Link>
                <button
                  onClick={handleLogout}
                  className="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                >
                  Đăng xuất
                </button>
              </div>
            </div>
          )}
        </div>
      </div>
    </nav>
  );
};

export default NavBar;
