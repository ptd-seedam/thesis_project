package com.seedam.library.management.repository;

import com.seedam.library.management.model.Publisher;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface PublisherRepository extends JpaRepository <Publisher, String> {
}
