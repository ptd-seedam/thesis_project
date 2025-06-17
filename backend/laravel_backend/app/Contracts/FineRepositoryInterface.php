<?php

namespace App\Contracts;

use App\Models\Fine;

interface FineRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Lấy các khoản phạt theo trạng thái đã trả hay chưa.
     */
    public function findByPaidStatus(bool $paidStatus);
    public function getAllUsers();
    public function getAllBorrowings();
}
