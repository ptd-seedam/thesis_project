package com.seedam.library.management.service;

import com.seedam.library.management.dto.request.Category.CategoryCreationRequest;
import com.seedam.library.management.dto.request.Category.CategoryUpdationRequest;
import com.seedam.library.management.model.Category;
import com.seedam.library.management.repository.CategoryRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class CategoryService {
    @Autowired
    private CategoryRepository categoryRepository;

    public List<Category> findAll() {
        return categoryRepository.findAll();
    }
    public Category findById(String id) {
        return categoryRepository.findById(id).orElse(null);
    }
    public  boolean delete(String id) {
        Category category = findById(id);
        if (category != null) {
            categoryRepository.delete(category);
            return true;
        }
        return false;
    }
    public Category create(CategoryCreationRequest request) {
        Category category = new Category();
        category.setName(request.getName());
        category.setDescription(request.getDescription());
        category.setStatus(true);
        return categoryRepository.save(category);
    }
    public Category update(CategoryUpdationRequest request, String id) {
        Category category = categoryRepository.findById(id).orElse(null);
        if (category != null) {
            category.setName(request.getName());
            category.setDescription(request.getDescription());
            category.setStatus(request.isStatus());
            return categoryRepository.save(category);
        }
        return null;
    }
}
