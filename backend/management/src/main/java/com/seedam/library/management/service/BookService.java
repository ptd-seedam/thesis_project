package com.seedam.library.management.service;

import com.seedam.library.management.dto.request.Book.BookCreationRequest;
import com.seedam.library.management.dto.request.Book.BookUpdationRequest;
import com.seedam.library.management.model.*;
import com.seedam.library.management.repository.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.Base64;
import java.util.List;
import java.util.UUID;

@Service
public class BookService {
    @Autowired
    private BookRepository bookRepository;

    @Autowired
    private PublisherRepository publisherRepository;

    @Autowired
    private AuthorRepository authorRepository;

    @Autowired
    private CategoryRepository categoryRepository;

    @Autowired
    private BookCategoryRepository bookCategoryRepository;

    @Autowired
    private ImageRepository imageRepository;

    public Book createBook(BookCreationRequest request) {
        Book book = new Book();
        book.setTitle(request.getTitle());
        book.setPublicDate(request.getPublicDate());
        book.setTotalCopies(request.getTotalCopies());
        book.setAvailableCopies(request.getAvailableCopies());
        book.setRate(request.getRate());
        book.setTotalRead(request.getTotalRead());

        // Gán tác giả
        Author author = authorRepository.findById(request.getAuthor_id())
                .orElseThrow(() -> new RuntimeException("Tác giả không tồn tại"));
        book.setAuthor(author);

        // Gán nhà xuất bản
        Publisher publisher = publisherRepository.findById(request.getPublisher_id())
                .orElseThrow(() -> new RuntimeException("Nhà xuất bản không tồn tại"));
        book.setPublisher(publisher);

        // Lưu sách
        Book savedBook = bookRepository.save(book);

        // Gán danh mục sách
        if (request.getCategoryIds() != null) {
            for (String categoryId : request.getCategoryIds()) {
                Category category = categoryRepository.findById(categoryId)
                        .orElseThrow(() -> new RuntimeException("Danh mục không tồn tại với ID: " + categoryId));
                BookCategory bookCategory = new BookCategory();

                bookCategory.setBook(savedBook);
                bookCategory.setCategory(category);

                bookCategoryRepository.save(bookCategory);
            }
        }
        if (request.getImageBase64() != null && !request.getImageBase64().isEmpty()) {
            try {
                // 1. Giải mã Base64
                byte[] imageBytes = Base64.getDecoder().decode(request.getImageBase64());

                // 2. Tạo tên file duy nhất
                String fileName = UUID.randomUUID().toString() + ".png";

                // 3. Đường dẫn lưu file trên server
                Path uploadPath = Paths.get("uploads/images");
                if (!Files.exists(uploadPath)) {
                    Files.createDirectories(uploadPath);
                }

                Path filePath = uploadPath.resolve(fileName);
                Files.write(filePath, imageBytes);

                // 4. Tạo đối tượng Image và lưu đường dẫn
                Image image = new Image();
                image.setBook(savedBook);
                image.setUrl("/uploads/images/" + fileName); // chỉ lưu URL tương đối

                imageRepository.save(image);
            } catch (IOException e) {
                throw new RuntimeException("Lỗi khi lưu ảnh", e);
            } catch (IllegalArgumentException e) {
                throw new RuntimeException("Chuỗi ảnh không hợp lệ (Base64)", e);
            }
        }
        return savedBook;
    }

    public Book findById(String id) {
        return bookRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Không tìm thấy sách với ID: " + id));
    }
    public List<Book> findByTitle(String title) {
        return bookRepository.findByTitle(title);
    }

    public List<Book> getAll() {
        return bookRepository.findAll();
    }

    public void deleteBook(String id) {
        if (bookRepository.existsById(id)) {
            bookCategoryRepository.deleteAllByBookId(id);
            bookRepository.deleteById(id);
        } else {
            throw new RuntimeException("Không tìm thấy sách để xóa");
        }
    }

    public Book updateBook(String bookId, BookUpdationRequest request) {
        // Lấy thông tin sách hiện tại
        Book book = bookRepository.findById(bookId)
                .orElseThrow(() -> new RuntimeException("Không tìm thấy sách với ID: " + bookId));

        // Cập nhật thông tin cơ bản
        book.setTitle(request.getTitle());
        book.setPublicDate(request.getPublicDate());
        book.setTotalCopies(request.getTotalCopies());
        book.setAvailableCopies(request.getAvailableCopies());
        book.setRate(request.getRate());
        book.setTotalRead(request.getTotalRead());

        // Cập nhật nhà xuất bản
        Publisher publisher = publisherRepository.findById(request.getPublisher_id())
                .orElseThrow(() -> new RuntimeException("Không tìm thấy publisher với ID: " + request.getPublisher_id()));
        book.setPublisher(publisher);

        // Cập nhật tác giả
        Author author = authorRepository.findById(request.getAuthor_id())
                .orElseThrow(() -> new RuntimeException("Không tìm thấy author với ID: " + request.getAuthor_id()));
        book.setAuthor(author);

        // Xoá tất cả các liên kết cũ với thể loại
        bookCategoryRepository.deleteAllByBookId(bookId);

        // Tạo mới danh sách thể loại
        List<Category> categories = categoryRepository.findAllById(request.getCategoryIds());
        List<BookCategory> bookCategories = new ArrayList<>();

        for (Category category : categories) {
            BookCategory bookCategory = new BookCategory();
            bookCategory.setBook(book);
            bookCategory.setCategory(category);
            bookCategories.add(bookCategory);
        }

        // Lưu các thể loại mới
        bookCategoryRepository.saveAll(bookCategories);
        book.setBookCategories(bookCategories);

        // --- Xử lý cập nhật hình ảnh từ Base64 ---
        if (request.getImageBase64() != null && !request.getImageBase64().isEmpty()) {
            try {
                byte[] imageBytes = Base64.getDecoder().decode(request.getImageBase64());
                String fileName = UUID.randomUUID().toString() + ".png";

                Path uploadPath = Paths.get("uploads/images");
                if (!Files.exists(uploadPath)) {
                    Files.createDirectories(uploadPath);
                }

                Path filePath = uploadPath.resolve(fileName);
                Files.write(filePath, imageBytes);

                // Xóa ảnh cũ nếu có
                imageRepository.deleteByBookId(bookId);

                Image image = new Image();
                image.setBook(book);
                image.setUrl("/uploads/images/" + fileName);

                imageRepository.save(image);
            } catch (IOException e) {
                throw new RuntimeException("Lỗi khi lưu ảnh", e);
            } catch (IllegalArgumentException e) {
                throw new RuntimeException("Chuỗi ảnh không hợp lệ (Base64)", e);
            }
        }

        // Lưu sách đã cập nhật
        return bookRepository.save(book);
    }

}

