import React from 'react';
import { useSidebar } from '../../../context/SidebarContext';
import NavDropdown from './NavDropdown';

function NavBar() {
  const { toggleSidebar } = useSidebar();

  return (
    <div className=''>
      <nav className="bg-amber-50 items-center rounded-2xl m-2 border-b border-gray-200 border-2 shadow-sm">
        <div className="max-w-7xl items-center mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between h-16 items-center">
            <div className="flex">
              <div className="flex-shrink-0 justify-center bg-amber-50 w-16 h-16">
                <button 
                  onClick={toggleSidebar}
                  className="flex items-center justify-center bg-amber-50 w-full h-full gap-2 text-blue-500 hover:bg-blue-50 hover:text-blue-600 rounded-full"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
                  </svg>
                </button>
              </div>
            </div>
            <div className="flex items-center">
              <NavDropdown />
            </div>
          </div>
        </div>
      </nav>
    </div>
  );
}

export default NavBar;