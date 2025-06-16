package com.seedam.library.management.repository;

import com.seedam.library.management.model.Book;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface BookRepository extends JpaRepository <Book, String>{
    List<Book> findByTitle(String title);
}
