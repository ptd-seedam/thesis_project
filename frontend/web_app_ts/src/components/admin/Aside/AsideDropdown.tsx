import React, { useState } from 'react';

function AsideDropdown() {
  const [isOpen, setIsOpen] = useState(false);

  // Mock user data (thay bằng API thật sau này)
  const mockUser = {
    name: "Nguyễn Văn A",
    email: "user@example.com",
    avatar: "https://i.pravatar.cc/150?img=3", // Ảnh mẫu
  };

  return (
    <div className="relative">
      {/* Avatar button */}
      <button
        onClick={() => setIsOpen(!isOpen)}
        className="flex items-center gap-2 focus:outline-none"
      >
        <img
          src={mockUser.avatar}
          alt="User avatar"
          className="w-8 h-8 rounded-full object-cover border border-gray-300"
        />
        <span className="hidden md:inline text-sm font-medium text-gray-700">
          {mockUser.name}
        </span>
      </button>

      {/* Dropdown menu */}
      {isOpen && (
        <div className="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
          {/* User info */}
          <div className="px-4 py-3 border-b">
            <p className="text-sm font-medium">{mockUser.name}</p>
            <p className="text-xs text-gray-500 truncate">{mockUser.email}</p>
          </div>
          
          {/* Menu items */}
          <a
            href="#"
            className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          >
            Hồ sơ cá nhân
          </a>
          <a
            href="#"
            className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          >
            Cài đặt
          </a>
          <a
            href="#"
            className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          >
            Lịch sử đơn hàng
          </a>

          {/* Logout (mock) */}
          <div className="border-t border-gray-200"></div>
          <button
            onClick={() => alert("Chức năng đăng xuất (sẽ thêm sau)")}
            className="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
          >
            Đăng xuất
          </button>
        </div>
      )}
    </div>
  );
}

export default AsideDropdown;