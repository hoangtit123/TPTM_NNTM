# 🚦 TPTM_NNTM – Hệ thống quản lý phương tiện thông minh

## 📌 Giới thiệu

**Hệ thống quản lý phương tiện thông minh** là hệ thống quản lý và xử lý thanh toán thông minh dành cho các mô hình IoT nhỏ gọn như:
- Quản lý bãi đỗ xe sử dụng **thẻ RFID**
- Gửi – nhận tín hiệu mở barrier
- Thanh toán và ghi nhận lịch sử gửi xe

Dự án sử dụng công nghệ **PHP + RFID + MySQL + Bootstrap** để triển khai hệ thống tương tác đơn giản qua giao diện web.

---

## ⚙️ Công nghệ sử dụng

- 🧠 **PHP**: Xử lý server-side logic
- 🗂️ **MySQL**: Quản lý dữ liệu RFID, log gửi xe, thanh toán
- 🌐 **HTML/CSS + Bootstrap**: Giao diện web responsive
- 🚪 **RFID + ESP32/Arduino**: Quét thẻ và điều khiển barrier
- 🔁 **AJAX/JavaScript**: Gửi tín hiệu không cần reload trang

---

## 🔁 Cơ chế hoạt động

Quy trình xử lý trong hệ thống được mô tả như sau:

1. Khi xe đến bãi, hệ thống quét **thẻ RFID** để xác định danh tính.
2. Nếu **hợp lệ**, hệ thống mở **barie cho xe vào** và ghi lại thời điểm vào.
3. Trong suốt quá trình xe gửi, hệ thống sẽ giám sát và ghi log.
4. Khi xe rời bãi, thẻ RFID lại được kiểm tra:
   - Nếu hợp lệ → hệ thống tính toán thời gian gửi, hiển thị **phí gửi xe**.
   - Nếu không hợp lệ (ví dụ chưa từng vào) → **báo lỗi**.
5. Sau khi thanh toán hoàn tất, **barie tự động mở**, xe được phép rời bãi.

---

### 🧭 Sơ đồ hoạt động minh hoạ:

<img src="images/bieudohoatdong.png" alt="Sơ đồ cơ chế hoạt động" width="700"/>

---

## 📝 Lưu ý:

- Tất cả dữ liệu quét thẻ, giờ vào – ra và thanh toán được lưu vào hệ thống cơ sở dữ liệu.
- Các điều kiện hợp lệ bao gồm: thẻ đúng, chưa vào trước đó, không rời bãi ảo...




