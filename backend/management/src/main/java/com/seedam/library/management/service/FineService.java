package com.seedam.library.management.service;

import com.seedam.library.management.dto.request.Fine.FineCreationRequest;
import com.seedam.library.management.dto.request.Fine.FineUpdateRequest;
import com.seedam.library.management.model.Borrowing;
import com.seedam.library.management.model.Fine;
import com.seedam.library.management.model.User;
import com.seedam.library.management.repository.FineRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.Collections;
import java.util.List;

@Service
public class FineService {
    @Autowired
    private FineRepository fineRepository;

    @Autowired
    private UserService userService;

    @Autowired
    private BorrowingService borrowingService;

    public Fine findById(String id) {
        return fineRepository.findById(id).orElse(null);
    }
    public List<Fine> findAll() {
        return fineRepository.findAll();
    }
    public List<Fine> findByEmail(String email) {
        User user = userService.findUserByEmail(email);
        if (user == null) {
            return Collections.emptyList();
        }
        return fineRepository.findByUser_UserId(user.getUserId());
    }
    public Fine create(FineCreationRequest request) {
        Fine fine = new Fine();
        fine.setAmount(request.getAmount());
        fine.setReason(request.getReason());
        fine.setIssuedDate(request.getIssuedDate());
        fine.setPaidStatus(request.getPaidStatus());
        User user = userService.findUserById(request.getUser_id());
        if (user == null) {
            return null;
        }
        fine.setUser(user);
        Borrowing borrowing = borrowingService.findById(request.getBorrowing_id());
        if (borrowing == null) {
            return null;
        }
        fine.setBorrowing(borrowing);
        return fineRepository.save(fine);
    }
    public Fine update(String id, FineUpdateRequest request) {
        Fine fine = fineRepository.findById(id).orElse(null);
        if (fine == null) {
            return null;
        }
        fine.setAmount(request.getAmount());
        fine.setReason(request.getReason());
        fine.setIssuedDate(request.getIssuedDate());
        fine.setPaidStatus(request.getPaidStatus());
        return fineRepository.save(fine);
    }
    public boolean delete(String id) {
        Fine fine = fineRepository.findById(id).orElse(null);
        if (fine == null) {
            return false;
        }
        fineRepository.delete(fine);
        return true;
    }
}
