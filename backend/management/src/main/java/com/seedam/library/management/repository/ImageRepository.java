package com.seedam.library.management.repository;

import com.seedam.library.management.model.Image;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ImageRepository extends JpaRepository<Image, String> {
    void deleteByBookId(String bookId);
}
