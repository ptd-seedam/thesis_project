<?php

namespace App\Services;

use App\Contracts\BookRepositoryInterface;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    protected BookRepositoryInterface $bookRepo;

    public function __construct(BookRepositoryInterface $bookRepo)
    {
        $this->bookRepo = $bookRepo;
    }

    public function getAllBooks(): Collection
    {
        return $this->bookRepo->all(['*'], ['author', 'category', 'publisher']);
    }

    public function getBookById(int $id): ?Book
    {
        return $this->bookRepo->getBookById($id);
    }

    public function createBook(array $data): ?Book
    {
        return $this->bookRepo->create($data);
    }

    public function updateBook(int $id, array $data): ?Book
    {
        return $this->bookRepo->update($id, $data);
    }

    public function deleteBook(int $id): bool
    {
        return $this->bookRepo->delete($id);
    }

    public function findBookByTitle(string $title): ?Book
    {
        return $this->bookRepo->findByTitle($title);
    }
    public function getAllAuthors(): Collection
    {
        return $this->bookRepo->getAllAuthors();
    }
    public function getAllCategories(): Collection
    {
        return $this->bookRepo->getAllCategories();
    }
    public function getAllPublishers(): Collection
    {
        return $this->bookRepo->getAllPublishers();
    }
    public function searchBooks(string $query): Collection
    {
        return $this->bookRepo->search($query);
    }
    public function getBooksByCategory(int $categoryId): Collection
    {
        return $this->bookRepo->getBookByCategory($categoryId);
    }
    public function decreaseBookStatus(int $bookId): bool
    {
        $book = $this->getBookById($bookId);

        if ($book) {
            if($book->B_AVAILABLE_COPIES <= 0) {
                return false; // Không thể mượn sách nếu không còn bản sao nào
            }
            $book->B_AVAILABLE_COPIES = $book->B_AVAILABLE_COPIES - 1;
            return $book->save();
        }
        return false;
    }
        public function increaseBookStatus(int $bookId): bool
    {
        $book = $this->getBookById($bookId);

        if ($book) {
            if($book->B_AVAILABLE_COPIES <= 0) {
                return false; // Không thể mượn sách nếu không còn bản sao nào
            }
            $book->B_AVAILABLE_COPIES = $book->B_AVAILABLE_COPIES + 1;
            return $book->save();
        }
        return false;
    }
}
