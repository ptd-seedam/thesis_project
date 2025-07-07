# Giới thiệu
Hệ thống quản lý thư viện thông minh là một giải pháp toàn diện cho việc quản lý thư viện hiện đại, tích hợp hệ thống gợi ý sách thông minh dựa trên sở thích và lịch sử xem sách trong phiên của người dùng của người dùng. Dự án sử dụng Laravel cho backend, ReactJS cho frontend, Hệ thống gợi ý sử dụng model LSTM.

#  Tính năng chính

## Cho tất cả người dùng

- Hệ thống gợi ý sách thông minh

- Tìm kiếm sách nâng cao

- Xem chi tiết sách, tác giả, nhà sản xuất

- Theo dõi lịch sử mượn, phạt

- Quản lý hồ sơ độc giả

## Thủ thư

- Quản lý quá trình mượn/trả sách

- Duyệt yêu cầu gia hạn

- Xử lý vi phạm/quá hạn

## Quản trị viên

- Quản lý toàn bộ hệ thống

- CRUD sách, thể loại, tác giả

- Quản lý tài khoản người dùng

- Phân quyền hệ thống

- Xem báo cáo thống kê

## Đọc giả

- Đặt mượn sách trực tuyến

- Gia hạn mượn sách

- Đánh giá và bình luận sách

- Lưu danh sách yêu thích

# Công nghệ sử dụng

## Backend (Laravel)

- Framework: Laravel 12.x

- Authentication: Laravel Sanctum

- API: RESTful API

- Database: MySQL

## Frontend (ReactJS)

- Framework: ReactJS

- API: RESTful API

## Hệ thống gợi ý Sản phẩm theo phiên (LSTM)
- Framework: TensorFlow/Keras
- Dữ liệu đầu vào: yoochosse_click
- Huấn luyện và đánh giá: Recall@20 (66%) Mrr@20 (22%)

# 🚀 Cài đặt và chạy

## Yêu cầu hệ thống
- PHP 8.1+

- Composer 2.x

- Node.js 16.x+

- MySQL 8.x

- NPM/Yarn

## Các bước cài đặt

### Clone dự án

```bash
git clone https://github.com/ptd-seedam/library_management.git
cd library-management-system
```

### Cài đặt backend
```bash
cd ./backend/laravel_backend
composer install
cp .env.example .env
php artisan key:generate
```
- Cấu hình database trong file .env
```bash
  php artisan migrate --seed
  php artisan serve
```

### Cài đặt hệ thống gợi ý
```bash
  cd ./LSTM_Recommend_System/API_PREDICT_SERVER
  python -m venv venv
  pip install -r requirements.txt
  python app.py
```
### Cài đặt frontend
```bash
cd ./frontend/web_app_ts
npm install
npm start
```
# 📞 Liên hệ
Email: seedam5000@gmail.com
Họ và tên: Phạm Trí Đạt



