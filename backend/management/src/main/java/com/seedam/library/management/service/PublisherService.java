package com.seedam.library.management.service;

import com.seedam.library.management.dto.request.Publisher.PublisherCreateRequest;
import com.seedam.library.management.dto.request.Publisher.PublisherUpdateRequest;
import com.seedam.library.management.model.Publisher;
import com.seedam.library.management.repository.PublisherRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class PublisherService {
    @Autowired
    private PublisherRepository publisherRepository;

    public Publisher findbyId(String id) {
        return publisherRepository.findById(id).orElse(null);
    }
    public List<Publisher> findAll() {
        return publisherRepository.findAll();
    }
    public boolean delete(String id) {
        Publisher publisher = findbyId(id);
        if (publisher != null) {
            publisherRepository.delete(publisher);
            return true;
        }
        return false;
    }
    public Publisher create(PublisherCreateRequest request) {
        Publisher publisher = new Publisher();
        publisher.setName(request.getName());
        publisher.setAddress(request.getAddress());
        publisher.setStatus(request.isStatus());
        return publisherRepository.save(publisher);
    }
    public Publisher update(PublisherUpdateRequest request, String id) {
        Publisher publisher = findbyId(id);
        if (publisher != null) { publisher.setName(request.getName());
            publisher.setAddress(request.getAddress());
            publisher.setStatus(request.isStatus());
            return publisherRepository.save(publisher);
        }
        return null;
    }

}
