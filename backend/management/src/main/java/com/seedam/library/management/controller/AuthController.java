package com.seedam.library.management.controller;

import com.seedam.library.management.dto.request.User.UserCreationRequest;
import com.seedam.library.management.repository.UserRepository;
import com.seedam.library.management.security.JwtUtil;
import com.seedam.library.management.security.CustomUserDetailsService;
import com.seedam.library.management.service.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.authentication.*;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/auth")
public class AuthController {

    @Autowired
    private AuthenticationManager authenticationManager;

    @Autowired
    private JwtUtil jwtUtil;

    @Autowired
    private CustomUserDetailsService userDetailsService;

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private UserService userService;

    @PostMapping("/login")
    public String login(@RequestParam String email, @RequestParam String password) {
        authenticationManager.authenticate(
                new UsernamePasswordAuthenticationToken(email, password)
        );

        UserDetails userDetails = userDetailsService.loadUserByUsername(email);
        return jwtUtil.generateToken(userDetails.getUsername());
    }
    @PostMapping("/register")
    public String register(@RequestBody UserCreationRequest request) {
        // Kiểm tra email đã tồn tại
        if (userRepository.findByEmail(request.getEmail()).isPresent()) {
            return "Email đã tồn tại!";
        }
        userService.register(request);
        return "Đăng ký thành công!";
    }
}