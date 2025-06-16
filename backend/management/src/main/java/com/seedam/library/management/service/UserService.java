package com.seedam.library.management.service;

import com.seedam.library.management.dto.request.User.UserCreationRequest;
import com.seedam.library.management.dto.request.User.UserUpdationRequest;
import com.seedam.library.management.model.User;
import com.seedam.library.management.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class UserService {

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private PasswordEncoder passwordEncoder;

    public User createUser(UserCreationRequest request) {
        User user = new User();
        user.setEmail(request.getEmail());
        user.setName(request.getName());
        user.setPhone(request.getPhone());
        user.setAddress(request.getAddress());
        user.setRole(request.getRole());
        user.setPassword(passwordEncoder.encode(request.getPassword()));

        return userRepository.save(user);
    }
    public User register(UserCreationRequest request) {
        User user = new User();
        user.setEmail(request.getEmail());
        user.setName(request.getName());
        user.setPhone(request.getPhone());
        user.setAddress(request.getAddress());
        user.setRole("reader");
        user.setPassword(passwordEncoder.encode(request.getPassword()));

        return userRepository.save(user);
    }
    public User findUserById(String id) {
        return userRepository.findById(id).orElse(null);
    }
    public User updateUser(UserUpdationRequest request, String id){
       User user = userRepository.findById(id).orElse(null);
       if(user != null){
           user.setName(request.getName());
           user.setPhone(request.getPhone());
           user.setAddress(request.getAddress());
           user.setRole(request.getRole());
           user.setPassword(passwordEncoder.encode(request.getPassword()));
           return userRepository.save(user);
       }
       return null;
    }
    public User findUserByEmail(String email) {
        return userRepository.findByEmail(email).orElse(null);
    }
    public boolean deleteUserById(String id){
        User user = userRepository.findById(id).orElse(null);
        if(user != null){
            userRepository.delete(user);
            return true;
        }
        return false;
    }
    public List<User> findAllUsers(){
        return userRepository.findAll();
    }

}
