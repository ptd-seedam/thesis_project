# Hệ Thống Quản Lý Thư Viện - Backend

## Giới thiệu
Phần backend của hệ thống quản lý thư viện được phát triển bằng Laravel, cung cấp API cho các chức năng quản lý sách, người dùng, mượn/trả sách và hệ thống gợi ý sách thông minh.

## Tính năng chính

### Quản lý sách
- Thêm/xóa/sửa thông tin sách
- Phân loại sách theo thể loại, tác giả
- Tìm kiếm và lọc sách nâng cao

### Quản lý người dùng
- 3 vai trò: Admin, Thủ thư, Độc giả
- Đăng ký, đăng nhập, quên mật khẩu
- Phân quyền chi tiết

### Hệ thống gợi ý sách
- Gợi ý dựa trên lịch sử mượn
- Gợi ý theo thể loại yêu thích
- Gợi ý sách phổ biến

### Quản lý mượn/trả sách
- Đặt mượn sách trực tuyến
- Gia hạn thời gian mượn
- Xử lý vi phạm/quá hạn
- Lịch sử mượn sách

## Công nghệ sử dụng

- **Framework**: Laravel 10.x
- **Database**: MySQL 8.x
- **API**: RESTful API
- **Authentication**: Laravel Sanctum
