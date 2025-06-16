import React from 'react'

function DashboardPage() {
  return (
    <div className='bg-white shadow-md rounded-lg p-6 m-4'>
      <div className="flex flex-col items-center justify-center min-h-screen bg-gray-50">
        <h1 className="text-4xl font-bold text-gray-800 mb-4">Dashboard</h1>
        <p className="text-lg text-gray-600">Chào mừng bạn đến với trang quản trị!</p>
      </div>
      <div className='mt-6'></div>
      <p className='text-gray-700'>Trang này sẽ hiển thị các thông tin thống kê và quản lý hệ thống.</p>

    </div>
  )
}

export default DashboardPage