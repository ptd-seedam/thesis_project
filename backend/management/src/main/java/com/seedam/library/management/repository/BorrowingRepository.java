package com.seedam.library.management.repository;

import com.seedam.library.management.model.Borrowing;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface BorrowingRepository extends JpaRepository <Borrowing, String>{
    List<Borrowing> findByUser_UserId(String userId);
}
