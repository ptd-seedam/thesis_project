<?php

namespace App\Contracts;

use App\Models\Author;

interface AuthorRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Tìm tác giả theo tên (ví dụ mở rộng thêm method tùy chỉnh).
     */
    public function findByName(string $name): ?Author;
}
