package com.seedam.library.management.repository;

import com.seedam.library.management.model.Fine;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface FineRepository extends JpaRepository<Fine, String> {
    List<Fine> findByUser_UserId(String UserId);
}
