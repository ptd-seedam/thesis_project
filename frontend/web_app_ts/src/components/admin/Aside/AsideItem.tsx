import React from 'react';

interface AsideProps {
  title: string;
  icon: React.ReactNode | string;
  link: string;
}

const AsideItem: React.FC<AsideProps> = ({ title, icon, link }) => {
  const renderIcon = () => {
    if (React.isValidElement(icon)) {
      return icon;
    }
    return <i className={`${icon} text-lg`}></i>;
  };

  return (
    <li className='group flex flex-col gap-2 p-3 rounded-lg hover:bg-gray-100 transition-colors'>
      <div className='flex items-center gap-3'>
        <span className="text-gray-600 group-hover:text-blue-600">
          {renderIcon()}
        </span>
        <p className='font-medium text-gray-800 group-hover:text-blue-600'>
          {title}
        </p>
      </div>
      
      <div className='flex flex-col pl-9 gap-1 text-sm'>
        <a 
          href={link} 
          className='text-gray-500 hover:text-gray-700 hover:underline transition-colors'
        >
          Danh sách {title}
        </a>
        <a 
          href={`${link}/create`} 
          className='text-gray-500 hover:text-gray-700 hover:underline transition-colors'
        >
          Thêm mới
        </a>
      </div>
    </li>
  );
};

export default AsideItem;