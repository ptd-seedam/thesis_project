import React from 'react';
import Dropdown from '../DropDown';
import type { Author } from '../../types/Author';

interface AuthorDropdownProps {
    author: Author[];
    isLoading?: boolean;
    onSelectCategory?: (author: Author) => void;
}

const AuthorDropdown: React.FC<AuthorDropdownProps> = ({
    author,
    isLoading = false
}) => {
    const [isOpen, setIsOpen] = React.useState(false);

    return (
        <Dropdown
            isOpen={isOpen}
            onToggle={() => setIsOpen(!isOpen)}
            trigger={
                <button className="">
                    Tác giả
                </button>
            }
        >
            {isLoading ? (
                <div className="p-2 text-gray-500">Đang tải...</div>
            ) : author.length > 0 ? (
                author.map((cat) => (
                    <div key={cat.A_ID} className="p-2 hover:bg-gray-100 cursor-pointer">
                        {cat.A_NAME}
                    </div>
                ))
            ) : (
                <div className="p-2 text-gray-500">Không có tác giả</div>
            )}
        </Dropdown>
    );
};

export default AuthorDropdown;