package com.seedam.library.management.repository;

import com.seedam.library.management.model.BookCategory;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface BookCategoryRepository extends JpaRepository<BookCategory, String> {
    void deleteAllByBookId(String bookId); // nếu có dùng trong `deleteBook`
}
