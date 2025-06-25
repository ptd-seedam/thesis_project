<?php

namespace App\Repositories;

use App\Contracts\BookRepositoryInterface;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Collection;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    public function findByTitle(string $title): ?Book
    {
        return $this->model->where('B_TITLE', $title)->first();
    }

    public function getAllBooks(): Collection
    {
        return $this->model->all();
    }

    public function createBook(array $data): Book
    {
        return $this->model->create($data);
    }

    public function updateBook(Book $book, array $data): Book
    {
        $book->update($data);

        return $book;
    }

    public function deleteBook(Book $book): bool
    {
        return $book->delete();
    }

    public function findBookById(int $id): ?Book
    {
        return $this->model->find($id);
    }

    public function getAllAuthors(): Collection
    {
        return Author::all();
    }

    public function getAllCategories(): Collection
    {
        return Category::all();
    }

    public function getAllPublishers(): Collection
    {
        return Publisher::all();
    }

    public function searchBooks(string $query): Collection
    {
        $books = $this->model
            ->with(['author', 'category', 'publisher'])
            ->where('B_TITLE', 'like', "%$query%")
            ->orWhere('B_DESCRIPTION', 'like', "%$query%")
            ->get();

        if ($books->isNotEmpty()) {
            return $books;
        }

        // Tìm theo tên thể loại
        $categoryIds = Category::where('C_NAME', 'like', "%$query%")->pluck('id');
        if ($categoryIds->isNotEmpty()) {
            $books = $this->model->with(['author', 'category', 'publisher'])->whereIn('C_ID', $categoryIds)->get();
            if ($books->isNotEmpty()) {
                return $books;
            }
        }

        // Tìm theo tác giả
        $authorIds = Author::where('A_NAME', 'like', "%$query%")->pluck('id');
        if ($authorIds->isNotEmpty()) {
            $books = $this->model->with(['author', 'category', 'publisher'])->whereIn('A_ID', $authorIds)->get();
            if ($books->isNotEmpty()) {
                return $books;
            }
        }

        // Tìm theo nhà xuất bản
        $publisherIds = Publisher::where('P_NAME', 'like', "%$query%")->pluck('id');
        if ($publisherIds->isNotEmpty()) {
            $books = $this->model->with(['author', 'category', 'publisher'])->whereIn('P_ID', $publisherIds)->get();
            if ($books->isNotEmpty()) {
                return $books;
            }
        }

        return collect(); // trả về collection rỗng nếu không tìm thấy gì
    }

    public function getBookById(int $id, array $columns = ['*'], array $relations = []): ?Book
    {
        return $this->model->with($relations)->find($id, $columns);
    }

    public function getBooksByCategory(int $categoryId): Collection
    {
        return $this->model->where('C_ID', $categoryId)->get();
    }

    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    public function findById(int $id, array $columns = ['*'], array $relations = []): ?Book
    {
        return $this->model->with($relations)->find($id, $columns);
    }

    public function create(array $data): ?Book
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): ?Book
    {
        $book = $this->findById($id);
        if ($book) {
            $book->update($data);

            return $book;
        }

        return null;
    }

    public function delete(int $id): bool
    {
        $book = $this->findById($id);
        if ($book) {
            return $book->delete();
        }

        return false;
    }

    public function getBookByAuthor(int $authorId, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->where('A_ID', $authorId)->with($relations)->get($columns);
    }

    public function getBookByPublisher(int $publisherId, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->where('P_ID', $publisherId)->with($relations)->get($columns);
    }

    public function search(string $query): Collection
    {
        return $this->model->where('B_TITLE', 'like', '%'.$query.'%')->get();
    }

    public function getBookByCategory(int $categoryId, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->where('C_ID', $categoryId)->with($relations)->get($columns);
    }

    public function getBookRandom(int $limit = 10): Collection
    {
        return $this->model
            ->with(['author', 'publisher', 'category'])
            ->inRandomOrder()
            ->take($limit)
            ->get();
    }
}
