package com.seedam.library.management.service;

import com.seedam.library.management.dto.request.Borrowing.BorrowingCreationRequest;
import com.seedam.library.management.dto.request.Borrowing.BorrowingUpdationRequest;
import com.seedam.library.management.model.Book;
import com.seedam.library.management.model.Borrowing;
import com.seedam.library.management.model.User;
import com.seedam.library.management.repository.BorrowingRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

@Service
public class BorrowingService {
    @Autowired
    private BorrowingRepository borrowingRepository;
    @Autowired
    private UserService userService;
    @Autowired
    private BookService bookService;

    public List<Borrowing> findAll() {
        return borrowingRepository.findAll();
    }
    public List<Borrowing> findByEmail(String email) {
        User user = userService.findUserByEmail(email);
        if (user == null) {
            return Collections.emptyList();
        }
        return borrowingRepository.findByUser_UserId(user.getUserId());
    }
    public Borrowing findById(String id) {
        return borrowingRepository.findById(id).get();
    }
    public Borrowing create(BorrowingCreationRequest request) {
        Borrowing borrowing = new Borrowing();
        borrowing.setBorrowDate(request.getBorrowDate());
        borrowing.setDueDate(request.getDueDate());
        borrowing.setReturnDate(request.getReturnDate());
        borrowing.setStatus(request.getStatus());

        User user = userService.findUserById(request.getUser_id());
        if (user == null) {
            return null;
        }
        borrowing.setUser(user);
        Book book  = bookService.findById(request.getBook_ìd());
        if (book == null) {
            return null;
        }
        borrowing.setBook(book);
        return borrowingRepository.save(borrowing);
    }
    public Borrowing update(BorrowingUpdationRequest request, String id) {
        Borrowing borrowing = borrowingRepository.findById(id).get();
        borrowing.setBorrowDate(request.getBorrowDate());
        borrowing.setDueDate(request.getDueDate());
        borrowing.setReturnDate(request.getReturnDate());
        borrowing.setStatus(request.getStatus());
        return borrowingRepository.save(borrowing);
    }
    public boolean delete(String id) {
        Borrowing borrowing = borrowingRepository.findById(id).get();
        if (borrowing == null) {
            return false;
        }
        borrowingRepository.delete(borrowing);
        return true;
    }
}
