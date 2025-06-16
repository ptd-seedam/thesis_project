package com.seedam.library.management.service;

import com.seedam.library.management.dto.request.Author.AuthorCreationRequest;
import com.seedam.library.management.dto.request.Author.AuthorUpdationRequest;
import com.seedam.library.management.model.Author;
import com.seedam.library.management.repository.AuthorRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class AuthorService {
    @Autowired
    private AuthorRepository authorRepository;

    public Author create(AuthorCreationRequest request){
        Author author = new Author();
        author.setName(request.getName());
        author.setDescription(request.getDescription());
        return authorRepository.save(author);
    }

    public List<Author> findAll(){
        return authorRepository.findAll();
    }

    public Author update(AuthorUpdationRequest request, String id){
        Author author = authorRepository.findById(id).orElse(null);
        if(author != null){
            author.setName(request.getName());
            author.setDescription(request.getDescription());
            return authorRepository.save(author);
        }
        return null;
    }

    public Author findById(String id){
        return authorRepository.findById(id).orElse(null);
    }

    public boolean deleteById(String id){
        Author author = authorRepository.findById(id).orElse(null);
        if(author != null){
            authorRepository.delete(author);
            return true;
        }
        return false;
    }
}
