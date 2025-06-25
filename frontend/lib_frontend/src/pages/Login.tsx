// src/pages/Login.tsx
import React from 'react';
import LoginForm from'../components/Login/LoginForm';

const Login = () => {
  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-50 p-4">
      <div className="w-full max-w-md space-y-6 bg-white p-8 rounded-lg shadow">
        <div className="text-center">
          <h2 className="text-3xl font-bold text-gray-900">Đăng nhập</h2>
          <p className="text-sm text-gray-600">Vui lòng đăng nhập để tiếp tục</p>
        </div>
        <LoginForm />
      </div>
    </div>
  );
};

export default Login;
