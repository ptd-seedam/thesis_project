# Hệ Thống Gợi Ý Sách - API Server (LSTM)

## Giới thiệu
Module gợi ý sách sử dụng mô hình LSTM (Long Short-Term Memory) để phân tích và dự đoán sở thích đọc sách của người dùng dựa trên lịch sử phiên truy cập và tương tác.

## Mô hình LSTM
- Phân tích chuỗi hành vi người dùng theo phiên
## 📡 API Endpoints

### 1. Lấy gợi ý sách theo phiên hiện tại
```bash
  POST /predict
```
- Yêu cầu
```bash
  {
    "session_items" : "1, 2, 3, ..."
  }
```
- Trả về
```bash
{
  "recommendations" : "4, 5, 6, ..."
  "session_items": "1, 2, 3, .."
}
```
#  Quy trình xử lý
- Thu thập dữ liệu phiên (user actions)

- Tiền xử lý và chuẩn hóa dữ liệu

- Đưa vào mô hình LSTM để dự đoán

- Trả về kết quả gợi ý
