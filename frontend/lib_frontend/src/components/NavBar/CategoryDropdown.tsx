import React from 'react';
import Dropdown from '../DropDown';
import type { Category } from '../../types/Category';

interface CategoryDropdownProps {
    categories: Category[];
    isLoading?: boolean;
    onSelectCategory?: (category: Category) => void;
}

const CategoryDropdown: React.FC<CategoryDropdownProps> = ({
    categories,
    isLoading = false
}) => {
    const [isOpen, setIsOpen] = React.useState(false);

    return (
        <Dropdown
            isOpen={isOpen}
            onToggle={() => setIsOpen(!isOpen)}
            trigger={
                <button className="">
                    Thể loại
                </button>
            }
        >
            {isLoading ? (
                <div className="p-2 text-gray-500">Đang tải...</div>
            ) : categories.length > 0 ? (
                categories.map((cat) => (
                    <div key={cat.C_ID} className="p-2 w-full hover:bg-gray-100 cursor-pointer">
                        {cat.C_NAME}
                    </div>
                ))
            ) : (
                <div className="p-2 text-gray-500">Không có danh mục</div>
            )}
        </Dropdown>
    );
};

export default CategoryDropdown;