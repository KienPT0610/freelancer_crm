`# Dự án Hệ Thống Quản Lý Khách Hàng Freelancer

## Mô tả dự án

Dự án này nhằm mục đích xây dựng một hệ thống quản lý khách hàng toàn diện dành cho freelancer. Hệ thống sẽ cung cấp các chức năng quản lý thông tin khách hàng, theo dõi dự án, quản lý nội dung trang web cá nhân (portfolio, dịch vụ, v.v.) và các công cụ hỗ trợ công việc freelancer khác.

## Cấu trúc thư mục`

freelancer_crm/
├── app/
│ ├── controllers/
│ ├── models/
│ ├── views/
│ ├── core/
│ └── config/
├── public/
├── database/
├── vendor/
├── composer.json
├── composer.lock
└── README.md

`* **`app/`\*\*: Chứa toàn bộ mã nguồn ứng dụng.

- **`public/`**: Thư mục gốc của website.
- **`database/`**: Chứa các file liên quan đến cơ sở dữ liệu (ví dụ: migrations).
- **`vendor/`**: Chứa các thư viện của Composer.
- `composer.json`, `composer.lock`: Các file quản lý dependency của Composer.
- `README.md`: File này, mô tả tổng quan về dự án.

## Yêu cầu hệ thống

- PHP phiên bản >= 7.4
- Web server (ví dụ: Apache, Nginx)
- Hệ quản trị cơ sở dữ liệu (ví dụ: MySQL, PostgreSQL)
- Composer (để quản lý dependency)

## Hướng dẫn cài đặt

1.  Clone repository dự án (nếu có).
2.  Cài đặt các dependency bằng Composer: `composer install`
3.  Sao chép file cấu hình cơ sở dữ liệu (`app/config/database.php.example` thành `app/config/database.php`) và cấu hình thông tin kết nối cơ sở dữ liệu của bạn.
4.  Cấu hình file `app/config/config.php` (ví dụ: `base_url`).
5.  Thiết lập web server để trỏ thư mục gốc (`DocumentRoot`) vào thư mục `public/`.
6.  Chạy migrations để tạo cấu trúc cơ sở dữ liệu. (Hướng dẫn chi tiết sẽ được cung cấp sau)

## Cách chạy dự án

1.  **Đảm bảo web server đã được cài đặt và cấu hình đúng.** Ví dụ, nếu bạn sử dụng Apache, hãy đảm bảo module `mod_rewrite` đã được kích hoạt (nếu bạn định sử dụng rewrite URL).
2.  **Khởi động web server của bạn. `php -S localhost:3000`**
3.  **Truy cập dự án thông qua trình duyệt web.** Sử dụng URL mà bạn đã cấu hình cho web server (ví dụ: `http://localhost/freelancer_crm/` nếu `public/` là thư mục gốc).

    - Nếu bạn đã cấu hình Virtual Host, bạn có thể truy cập bằng tên miền đã cấu hình (ví dụ: `http://freelancer.local/`).

## Hướng phát triển tiếp theo

- Xây dựng các lớp lõi (Controller, Model, Database, Router).
- Triển khai hệ thống định tuyến cơ bản.
- Thiết kế và xây dựng các model tương ứng với các bảng cơ sở dữ liệu đã được định nghĩa.
- Phát triển các controller để xử lý logic cho từng chức năng (ví dụ: quản lý khách hàng, quản lý dự án).
- Xây dựng giao diện người dùng (views) cho các chức năng.
- Tích hợp các thư viện hỗ trợ (ví dụ: xác thực, phân trang).

## Đặc tả các components/chức năng phức tạp (sẽ được bổ sung khi phát triển)

- **Hệ thống định tuyến (Router):** (Đặc tả chi tiết về cách URL được ánh xạ đến controller và action sẽ được viết sau).
- **Lớp Database:** (Đặc tả chi tiết về cách kết nối, truy vấn và xử lý dữ liệu với cơ sở dữ liệu sẽ được viết sau).
- **Quản lý khách hàng:** (Đặc tả chi tiết về các phương thức thêm, sửa, xóa, xem thông tin khách hàng sẽ được viết sau).`
