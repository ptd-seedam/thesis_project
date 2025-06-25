import React from 'react'
import SlideBook from '../components/SlideBook/SlideBook'
import { SlideBookHook } from '../hooks/SlideBookHook'

function Index() {
  const { books, booksPredict } = SlideBookHook();

  return (
    <div className='flex flex-col w-full items-center justify-center'>
      <div className='max-w-4xl w-full p-6 shadow-md rounded-lg mt-10 bg-amber-50'>
        <h1 className='text-2xl font-bold text-center'>Trang chủ</h1>
        <p className='text-center mt-4'>Chào mừng bạn đến với Nhà sách nụ cười của chúng tôi!</p>
        <p className='text-center mt-4'>Khám phá các thể loại sách và tác giả yêu thích của bạn.</p>
      </div>

      <SlideBook title='Sách nổi bật' books={books} />

      <SlideBook title='Sách gợi ý cho bạn' books={booksPredict} />
    </div>
  );
}

export default Index;
