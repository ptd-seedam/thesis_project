import React from 'react';
import SlideBook from '../components/SlideBook/SlideBook';
import { SlideBookHook } from '../hooks/SlideBookHook';


function Index() {
  const { books, booksPredict } = SlideBookHook();

  return (
    <div className='flex w-full flex-col items-center justify-center min-h-screen bg-gray-50'>
      {/* Main content container */}
      <div className='w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-8'>
        {/* Welcome Banner */}
        <div className='w-full p-6 shadow-md rounded-lg mt-4 md:mt-10 bg-gradient-to-r from-blue-50 to-blue-100 text-center'>
          <h1 className='text-2xl md:text-3xl font-bold text-gray-800 mb-2'>Trang chủ</h1>
          <p className='text-gray-700 text-sm md:text-base'>
            Chào mừng bạn đến với Nhà sách nụ cười của chúng tôi!
          </p>
          <p className='text-gray-700 mt-2 text-sm md:text-base'>
            Khám phá các thể loại sách và tác giả yêu thích của bạn.
          </p>
        </div>

        {/* Books sections container */}
        <div className='w-full flex flex-col items-center justify-center mt-8 space-y-12'>
          {/* Featured books section */}
          <div className='w-full'>
            {books && books.length > 0 && (
              <>
                <SlideBook title='Sách nổi bật' books={books} />
              </>
            )}
          </div>

          {/* Recommended books section */}
          <div className='w-full'>
            {booksPredict && booksPredict.length > 0 && (
              <>
                <SlideBook title='Sách gợi ý cho bạn' books={booksPredict} />
              </>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}


export default Index;