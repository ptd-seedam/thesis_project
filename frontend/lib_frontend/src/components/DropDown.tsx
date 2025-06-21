
import React from 'react';
import type { ReactNode } from 'react';
import { useEffect, useRef } from 'react';

interface DropdownProps {
    trigger: ReactNode; // Nội dung nút kích hoạt dropdown
    children: ReactNode; // Nội dung dropdown
    isOpen: boolean; // Trạng thái mở/đóng
    onToggle: () => void; // Hàm xử lý khi toggle
    className?: string;
}

const Dropdown: React.FC<DropdownProps> = ({
    trigger,
    children,
    isOpen,
    onToggle,
    className = ''
}) => {
    const dropdownRef = useRef<HTMLDivElement>(null);

    // Auto đóng khi click bên ngoài
    useEffect(() => {
        const handleClickOutside = (event: MouseEvent) => {
            if (
                dropdownRef.current &&
                !dropdownRef.current.contains(event.target as Node)
            ) {
                if (isOpen) onToggle(); // đóng dropdown nếu đang mở
            }
        };

        document.addEventListener('mousedown', handleClickOutside);
        return () => document.removeEventListener('mousedown', handleClickOutside);
    }, [isOpen, onToggle]);

    return (
        <div
            ref={dropdownRef}
            className={`relative ${className}`}
        >
            <div
                onClick={onToggle}
                className="cursor-pointer inline-flex items-center gap-2 px-4 py-2 rounded-4xl hover:text-blue-700S transition"
                style={{ color: '#060E26' }}
            >
                {trigger}
                <svg
                    className={`w-4 h-4 transform transition-transform duration-200 ${isOpen ? 'rotate-180' : ''
                        }`}
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            {isOpen && (
                <div className="absolute left-0 mt-2 w-64 grid grid-cols-2 gap-2 bg-white text-gray-800 shadow-xl rounded-lg z-50 border border-gray-200 max-h-60 overflow-y-auto p-2 animate-fade-in">
                    {children}
                </div>
            )}
        </div>

    );
};

export default Dropdown;