<?php
// Định nghĩa các prompt training cho AI
return $prompt = [
    // Prompt hệ thống cơ bản
    'system' => [
        'role' => 'system',
        'content' => "Bạn là trợ lý ảo CRM, giúp người dùng quản lý khách hàng, dự án và tương tác. Bạn có thể:
1. Hiển thị danh sách khách hàng
2. Thêm khách hàng mới với các thông tin: tên, email, số điện thoại, công ty, địa chỉ, nguồn, trạng thái, thẻ và ghi chú
3. Xem chi tiết khách hàng
4. Cập nhật thông tin khách hàng
5. Xóa khách hàng
6. Thêm tương tác với khách hàng
7. Xem lịch sử tương tác với khách hàng"
    ],

    // Prompt về thời gian
    'time_context' => [
        'role' => 'system',
        'content' => "Thông tin thời gian:
- Thời gian hiện tại: {current_time}
- Múi giờ: Asia/Ho_Chi_Minh (UTC+7)
- Ngày trong tuần: 7
- Ngày trong tháng: 23
- Tháng: 05
- Năm: 2025"
    ],

    // Prompt về danh sách khách hàng
    'customer_list' => [
        'role' => 'system',
        'content' => "Danh sách khách hàng hiện tại:
ID: 15
Tên: Nguyễn Văn An
Email: nguyenvana@example.com
Số điện thoại: 0901234567
Công ty: Công ty ABCD
Địa chỉ: 123 Đường Láng, Hà Nội
Ghi chú: Khách hàng tiềm năng lớn
Nguồn: LinkedIn
Trạng thái: Potential
Thẻ: vip,tech
Ngày tạo: 2025-02-01 09:00:00
Ngày cập nhật: 2025-05-23 04:17:40
Hình ảnh: 682ded07d735b-dog.4002.jpg
Ngày sinh: 1985-07-16

ID: 16
Tên: Trần Thị Bình
Email: tranthib@example.com
Số điện thoại: 0912345678
Công ty: NULL
Địa chỉ: 456 Lê Lợi, TP.HCM
Ghi chú: Cần follow-up gấp
Nguồn: Referral
Trạng thái: Active
Thẻ: SME
Ngày tạo: 2025-02-15 14:30:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: 682ded5cec6d6-08983710bb110e4f5700.jpg
Ngày sinh: 1990-03-10

ID: 17
Tên: Phạm Minh Chính
Email: pmc@gmail.com
Số điện thoại: 0923456789
Công ty: Công ty XYZ
Địa chỉ: 789 Nguyễn Huệ, Đà Nẵng
Ghi chú: Khách hàng cũ, tái hợp tác
Nguồn: LinkedIn
Trạng thái: Active
Thẻ: tech,returning
Ngày tạo: 2025-03-10 11:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: 682ded6dc36e5-54d4016d-fc57-476b-a3f6-420fc1da3f07.jpg
Ngày sinh: 1975-09-20

ID: 18
Tên: Lê Thị Duyên
Email: lethid@example.com
Số điện thoại: 0901234567
Công ty: NULL
Địa chỉ: 101 Hai Bà Trưng, Hà Nội
Ghi chú: Khách hàng quan tâm đến dịch vụ thiết kế website
Nguồn: Website
Trạng thái: Completed
Thẻ: vip,tech
Ngày tạo: 2025-04-05 08:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: 682def4fd2edd-7944a7f62bf79ea9c7e6.jpg
Ngày sinh: 1992-11-08

ID: 19
Tên: Hoàng Văn Hùng
Email: hoangvanh@example.com
Số điện thoại: 0934567890
Công ty: Công ty Hitech
Địa chỉ: 321 Trần Phú, Hà Nội
Ghi chú: Khách hàng quan tâm đến AI
Nguồn: Website
Trạng thái: Potential
Thẻ: tech,AI
Ngày tạo: 2025-04-15 10:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1988-12-01

ID: 20
Tên: Nguyễn Thị Lan
Email: NULL
Số điện thoại: 0945678901
Công ty: NULL
Địa chỉ: 654 Nguyễn Trãi, TP.HCM
Ghi chú: Cần tư vấn về website
Nguồn: Referral
Trạng thái: Active
Thẻ: SME,retail
Ngày tạo: 2025-04-20 13:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1995-06-21

ID: 21
Tên: Trần Minh Khôi
Email: tranminhk@example.com
Số điện thoại: 0956789012
Công ty: Công ty K Solutions
Địa chỉ: 987 Lê Văn Sỹ, Đà Nẵng
Ghi chú: Hợp tác dài hạn
Nguồn: LinkedIn
Trạng thái: Potential
Thẻ: enterprise
Ngày tạo: 2025-04-25 11:30:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1983-02-25

ID: 22
Tên: Lê Thị Mai
Email: lethil@example.com
Số điện thoại: NULL
Công ty: Công ty L Tech
Địa chỉ: 123 Phạm Văn Đồng, Hà Nội
Ghi chú: Khách hàng VIP
Nguồn: Website
Trạng thái: Active
Thẻ: vip,tech
Ngày tạo: 2025-05-01 08:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1989-10-14

ID: 23
Tên: Phạm Văn Nam
Email: phamvanm@example.com
Số điện thoại: 0967890123
Công ty: NULL
Địa chỉ: 456 Nguyễn Đình Chiểu, TP.HCM
Ghi chú: NULL
Nguồn: Referral
Trạng thái: OnHold
Thẻ: NULL
Ngày tạo: 2025-05-02 15:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1979-04-04

ID: 24
Tên: Đỗ Thị Ngọc
Email: NULL
Số điện thoại: 0978901234
Công ty: Công ty N Retail
Địa chỉ: 789 Hoàng Diệu, Hải Phòng
Ghi chú: Chờ báo giá
Nguồn: Website
Trạng thái: Potential
Thẻ: retail
Ngày tạo: 2025-05-03 09:30:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1994-01-12

ID: 25
Tên: Vũ Minh Quang
Email: vuminho@example.com
Số điện thoại: 0989012345
Công ty: Công ty O Media
Địa chỉ: 101 Lê Lợi, Cần Thơ
Ghi chú: Khách hàng từ sự kiện
Nguồn: Event
Trạng thái: Active
Thẻ: media
Ngày tạo: 2025-05-04 12:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1991-05-17

ID: 26
Tên: Bùi Thị Phượng
Email: buithip@example.com
Số điện thoại: NULL
Công ty: NULL
Địa chỉ: 234 Hùng Vương, Nha Trang
Ghi chú: Quan tâm đến app mobile
Nguồn: Website
Trạng thái: Potential
Thẻ: SME,app
Ngày tạo: 2025-05-05 14:30:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1986-08-28

ID: 27
Tên: Ngô Văn Sơn
Email: ngovanq@example.com
Số điện thoại: 0990123456
Công ty: Công ty Q Logistics
Địa chỉ: 567 Nguyễn Văn Cừ, Hà Nội
Ghi chú: Cần giải pháp logistics
Nguồn: LinkedIn
Trạng thái: Active
Thẻ: logistics
Ngày tạo: 2025-05-06 11:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1980-11-30

ID: 28
Tên: Hà Thị Thảo
Email: NULL
Số điện thoại: 0901234568
Công ty: NULL
Địa chỉ: 890 Trần Hưng Đạo, TP.HCM
Ghi chú: Khách hàng mới
Nguồn: Referral
Trạng thái: Potential
Thẻ: NULL
Ngày tạo: 2025-05-07 10:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1997-09-09

ID: 29
Tên: Nguyễn Văn Bảo
Email: nguyenvanbao@example.com
Số điện thoại: 0902345679
Công ty: Công ty Bảo Tech
Địa chỉ: 234 Đường Láng, Hà Nội
Ghi chú: Quan tâm đến giải pháp AI
Nguồn: Website
Trạng thái: Potential
Thẻ: tech,AI
Ngày tạo: 2025-02-01 10:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1978-03-03

ID: 30
Tên: Trần Thị Cẩm
Email: tranthicam@example.com
Số điện thoại: NULL
Công ty: NULL
Địa chỉ: 567 Lê Lợi, TP.HCM
Ghi chú: Cần tư vấn website
Nguồn: Referral
Trạng thái: Active
Thẻ: SME
Ngày tạo: 2025-02-10 12:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1993-12-22

ID: 31
Tên: Phạm Minh Đạt
Email: phamminhdat@example.com
Số điện thoại: 0913456790
Công ty: Công ty Đạt Solutions
Địa chỉ: 890 Nguyễn Huệ, Đà Nẵng
Ghi chú: Hợp tác dài hạn
Nguồn: LinkedIn
Trạng thái: Potential
Thẻ: enterprise
Ngày tạo: 2025-02-15 11:00:00
Ngày cập nhật: 2025-05-23 04:01:38
Hình ảnh: NULL
Ngày sinh: 1984-07-07

ID: 32
Tên: Lê Thị Hồng
Email: lethihong@example.com
Số điện thoại: 0924567891
Công ty: Công ty Hồng Media
Địa chỉ: 123 Trần Phú, Hải Phòng
Ghi chú: Khách hàng từ sự kiện
Nguồn: Event
Trạng thái: Active
Thẻ: media
Ngày tạo: 2025-02-20 09:00:00
Ngày cập nhật: 2025-05-23 04:01:39
Hình ảnh: NULL
Ngày sinh: 1987-06-18

ID: 33
Tên: Hoàng Văn Khang
Email: NULL
Số điện thoại: 0935678902
Công ty: NULL
Địa chỉ: 456 Phạm Văn Đồng, Hà Nội
Ghi chú: NULL
Nguồn: Website
Trạng thái: OnHold
Thẻ: NULL
Ngày tạo: 2025-03-01 08:00:00
Ngày cập nhật: 2025-05-23 04:01:39
Hình ảnh: NULL
Ngày sinh: 1996-01-01

ID: 34
Tên: Nguyễn Thị Linh
Email: nguyenthilinh@example.com
Số điện thoại: 0946789013
Công ty: Công ty Linh Retail
Địa chỉ: 789 Nguyễn Đình Chiểu, TP.HCM
Ghi chú: Chờ báo giá
Nguồn: Website
Trạng thái: Potential
Thẻ: retail
Ngày tạo: 2025-03-05 10:00:00
Ngày cập nhật: 2025-05-23 04:01:39
Hình ảnh: NULL
Ngày sinh: 1992-05-05

ID: 35
Tên: Trần Minh Nhật
Email: tranminhnhat@example.com
Số điện thoại: NULL
Công ty: Công ty Nhật Tech
Địa chỉ: 101 Lê Văn Sỹ, Đà Nẵng
Ghi chú: Khách hàng VIP
Nguồn: LinkedIn
Trạng thái: Active
Thẻ: vip,tech
Ngày tạo: 2025-03-10 12:00:00
Ngày cập nhật: 2025-05-23 04:01:39
Hình ảnh: NULL
Ngày sinh: 1981-10-30

ID: 36
Tên: Lê Thị Oanh
Email: lethioanh@example.com
Số điện thoại: 0957890124
Công ty: NULL
Địa chỉ: 234 Hoàng Diệu, Cần Thơ
Ghi chú: Quan tâm đến app mobile
Nguồn: Referral
Trạng thái: Potential
Thẻ: SME,app
Ngày tạo: 2025-03-15 09:30:00
Ngày cập nhật: 2025-05-23 04:01:39
Hình ảnh: NULL
Ngày sinh: 1990-04-16

ID: 37
Tên: Phạm Văn Phong
Email: phamvanphong@example.com
Số điện thoại: 0968901235
Công ty: Công ty Phong Logistics
Địa chỉ: 567 Hùng Vương, Hà Nội
Ghi chú: Cần giải pháp logistics
Nguồn: LinkedIn
Trạng thái: Active
Thẻ: logistics
Ngày tạo: 2025-03-20 11:00:00
Ngày cập nhật: 2025-05-23 04:01:39
Hình ảnh: NULL
Ngày sinh: 1976-08-08

ID: 38
Tên: Đỗ Thị Quyên
Email: NULL
Số điện thoại: 0979012346
Công ty: NULL
Địa chỉ: 890 Nguyễn Văn Cừ, TP.HCM
Ghi chú: Khách hàng mới
Nguồn: Referral
Trạng thái: Potential
Thẻ: NULL
Ngày tạo: 2025-03-25 10:00:00
Ngày cập nhật: 2025-05-23 04:01:39
Hình ảnh: NULL
Ngày sinh: 1998-09-01

ID: 39
Tên: Vũ Minh Sang
Email: vuminhsang@example.com
Số điện thoại: 0980123457
Công ty: Công ty Sang Media
Địa chỉ: 123 Lê Lợi, Nha Trang
Ghi chú: Khách hàng từ sự kiện
Nguồn: Event
Trạng thái: Active
Thẻ: media
Ngày tạo: 2025-04-01 12:00:00
Ngày cập nhật: 2025-05-23 04:01:39
Hình ảnh: NULL
Ngày sinh: NULL

ID: 40
Tên: Bùi Thị Thư
Email: buithithu@example.com
Số điện thoại: NULL
Công ty: NULL
Địa chỉ: 456 Trần Hưng Đạo, Hà Nội
Ghi chú: Cần tư vấn SEO
Nguồn: Website
Trạng thái: Potential
Thẻ: SME,seo
Ngày tạo: 2025-04-05 09:00:00
Ngày cập nhật: 2025-04-05 09:00:00
Hình ảnh: NULL
Ngày sinh: NULL

ID: 41
Tên: Ngô Văn Tuấn
Email: ngovantuan@example.com
Số điện thoại: 0991234568
Công ty: Công ty Tuấn Solutions
Địa chỉ: 789 Phạm Văn Đồng, TP.HCM
Ghi chú: Hợp tác phát triển phần mềm
Nguồn: LinkedIn
Trạng thái: OnHold
Thẻ: tech
Ngày tạo: 2025-04-10 11:00:00
Ngày cập nhật: 2025-05-21 19:16:31
Hình ảnh: NULL
Ngày sinh: NULL

Tổng số khách hàng: 27
Mã khách hàng sẽ là KH0 + ID. Ví dụ ID 15 sẽ là KH015
Ngày sinh của khách hàng có dạng YYYY-MM-DD. ví dụ 1998-09-01 thì có nghĩa là ngày 01 tháng 09 năm 1998
Ví dụ hiện tại là ngày 23 tháng 05 năm 2025 định dạng (DD-MM-YYYY). Trong vòng 30 ngày tới (từ 23/05/2025 đến 22/06/2025) những khách hàng nào nằm trong khoảng thời gian này sẽ
được coi là sắp sinh nhật
"
    ],

    // Prompt về tương tác với khách hàng
    'interaction' => [
        'role' => 'system',
        'content' => "Lịch sử tương tác với khách hàng:
Tương tác:
  Mã tương tác: 39
  Mã khách hàng: 15
  Loại tương tác: Email
  Ngày tương tác: 2025-02-05 00:00:00
  Tóm tắt: Gửi email chào mừng và giới thiệu dịch vụ Freelanc...
  Người tạo: 1
  Ngày tạo: 2025-05-21 21:20:37

Tương tác:
  Mã tương tác: 40
  Mã khách hàng: 15
  Loại tương tác: Call
  Ngày tương tác: 2025-02-20 14:00:00
  Tóm tắt: Thảo luận chi tiết về yêu cầu website
  Người tạo: 1
  Ngày tạo: 2025-02-20 14:00:00

Tương tác:
  Mã tương tác: 41
  Mã khách hàng: 15
  Loại tương tác: Meeting
  Ngày tương tác: 2025-03-10 10:00:00
  Tóm tắt: Gặp mặt để ký hợp đồng dự án
  Người tạo: 1
  Ngày tạo: 2025-03-10 10:00:00

Tương tác:
  Mã tương tác: 42
  Mã khách hàng: 16
  Loại tương tác: Email
  Ngày tương tác: 2025-02-18 11:00:00
  Tóm tắt: Gửi báo giá ứng dụng mobile
  Người tạo: 1
  Ngày tạo: 2025-02-18 11:00:00

Tương tác:
  Mã tương tác: 43
  Mã khách hàng: 16
  Loại tương tác: Meeting
  Ngày tương tác: 2025-03-01 09:30:00
  Tóm tắt: Trình bày demo ứng dụng
  Người tạo: 1
  Ngày tạo: 2025-03-01 09:30:00

Tương tác:
  Mã tương tác: 44
  Mã khách hàng: 17
  Loại tương tác: Call
  Ngày tương tác: 2025-03-05 15:00:00
  Tóm tắt: Xác nhận hoàn thành tái thiết kế UI
  Người tạo: 1
  Ngày tạo: 2025-03-05 15:00:00

Tương tác:
  Mã tương tác: 45
  Mã khách hàng: 17
  Loại tương tác: Email
  Ngày tương tác: 2025-04-06 08:00:00
  Tóm tắt: Gửi mockup website portfolio
  Người tạo: 1
  Ngày tạo: 2025-04-06 08:00:00

Tương tác:
  Mã tương tác: 46
  Mã khách hàng: 18
  Loại tương tác: Meeting
  Ngày tương tác: 2025-04-25 13:00:00
  Tóm tắt: Thảo luận yêu cầu hệ thống CRM
  Người tạo: 1
  Ngày tạo: 2025-04-25 13:00:00

Tương tác:
  Mã tương tác: 47
  Mã khách hàng: 19
  Loại tương tác: Call
  Ngày tương tác: 2025-04-22 10:00:00
  Tóm tắt: Tư vấn giải pháp website SME
  Người tạo: 1
  Ngày tạo: 2025-04-22 10:00:00

Tương tác:
  Mã tương tác: 48
  Mã khách hàng: 20
  Loại tương tác: Email
  Ngày tương tác: 2025-04-26 09:00:00
  Tóm tắt: Gửi đề xuất ứng dụng quản lý
  Người tạo: 1
  Ngày tạo: 2025-04-26 09:00:00

Tương tác:
  Mã tương tác: 49
  Mã khách hàng: 20
  Loại tương tác: Meeting
  Ngày tương tác: 2025-05-01 11:00:00
  Tóm tắt: Ký hợp đồng dự án app
  Người tạo: 1
  Ngày tạo: 2025-05-01 11:00:00

Tương tác:
  Mã tương tác: 50
  Mã khách hàng: 21
  Loại tương tác: Email
  Ngày tương tác: 2025-05-01 09:00:00
  Tóm tắt: Gửi yêu cầu thiết kế website
  Người tạo: 1
  Ngày tạo: 2025-05-01 09:00:00

Tương tác:
  Mã tương tác: 51
  Mã khách hàng: 21
  Loại tương tác: Call
  Ngày tương tác: 2025-05-02 14:00:00
  Tóm tắt: Thảo luận chi tiết về website công ty
  Người tạo: 1
  Ngày tạo: 2025-05-02 14:00:00

Tương tác:
  Mã tương tác: 52
  Mã khách hàng: 22
  Loại tương tác: Call
  Ngày tương tác: 2025-05-03 09:00:00
  Tóm tắt: Thảo luận yêu cầu dự án
  Người tạo: 1
  Ngày tạo: 2025-05-03 09:00:00

Tương tác:
  Mã tương tác: 53
  Mã khách hàng: 23
  Loại tương tác: Email
  Ngày tương tác: 2025-05-04 10:00:00
  Tóm tắt: Gửi báo giá hệ thống bán lẻ
  Người tạo: 1
  Ngày tạo: 2025-05-04 10:00:00

Tương tác:
  Mã tương tác: 54
  Mã khách hàng: 24
  Loại tương tác: Meeting
  Ngày tương tác: 2025-05-05 12:00:00
  Tóm tắt: Trình bày kế hoạch website truyền thông
  Người tạo: 1
  Ngày tạo: 2025-05-05 12:00:00

Tương tác:
  Mã tương tác: 55
  Mã khách hàng: 25
  Loại tương tác: Email
  Ngày tương tác: 2025-05-06 09:00:00
  Tóm tắt: Gửi thông tin dịch vụ app mobile
  Người tạo: 1
  Ngày tạo: 2025-05-06 09:00:00

Tương tác:
  Mã tương tác: 56
  Mã khách hàng: 26
  Loại tương tác: Call
  Ngày tương tác: 2025-05-07 11:00:00
  Tóm tắt: Tư vấn giải pháp logistics
  Người tạo: 1
  Ngày tạo: 2025-05-07 11:00:00

Tương tác:
  Mã tương tác: 57
  Mã khách hàng: 27
  Loại tương tác: Email
  Ngày tương tác: 2025-05-08 10:00:00
  Tóm tắt: Chào mừng khách hàng mới
  Người tạo: 1
  Ngày tạo: 2025-05-08 10:00:00

Tương tác:
  Mã tương tác: 58
  Mã khách hàng: 16
  Loại tương tác: Email
  Ngày tương tác: 2025-05-21 18:41:00
  Tóm tắt: Chúc mừng sinh nhật
  Người tạo: NULL
  Ngày tạo: 2025-05-21 18:41:20

Tương tác:
  Mã tương tác: 59
  Mã khách hàng: 16
  Loại tương tác: Email
  Ngày tương tác: 2025-05-21 18:41:00
  Tóm tắt: Hoàn thành dự án
  Người tạo: NULL
  Ngày tạo: 2025-05-21 18:43:27

Tương tác:
  Mã tương tác: 60
  Mã khách hàng: 16
  Loại tương tác: Call
  Ngày tương tác: 2025-05-21 18:43:00
  Tóm tắt: Gọi điện tư vấn
  Người tạo: 1
  Ngày tạo: 2025-05-21 18:45:34

Tương tác:
  Mã tương tác: 66
  Mã khách hàng: 41
  Loại tương tác: Email
  Ngày tương tác: 2025-05-21 00:00:00
  Tóm tắt: Trao đổi giá sp
  Người tạo: 1
  Ngày tạo: 2025-05-21 21:08:42

Tương tác:
  Mã tương tác: 75
  Mã khách hàng: 15
  Loại tương tác: Email
  Ngày tương tác: 2025-05-21 21:23:00
  Tóm tắt: Chúc mừng sinh nhật khách hàng
  Người tạo: 1
  Ngày tạo: 2025-05-21 21:25:22

Tương tác:
  Mã tương tác: 76
  Mã khách hàng: 23
  Loại tương tác: Email
  Ngày tương tác: 2025-05-21 00:00:00
  Tóm tắt: Chúc mừng sinh nhật bạn!
  Người tạo: 1
  Ngày tạo: 2025-05-21 22:16:02


Tổng số tương tác: bẳng tổng số tương tác ở trên
Mã khách hàng sẽ liên kết với bảng khách hàng 
Người tạo 1 có nghĩa là Admin
"
    ],

    // Prompt về dự án
    'project' => [
        'role' => 'system',
        'content' => "Danh sách dự án:
Dự án:
  Mã dự án: 11
  Mã khách hàng: 15
  Tên dự án: Website Thương mại ABC
  Mô tả: Phát triển website bán hàng trực tuyến
  Ngày bắt đầu: 2025-03-01
  Ngày kết thúc: 2025-07-31
  Trạng thái: InProgress
  Giá trị: 20000000.0
  Ngày tạo: 2025-02-15 10:00:00
  Ngày cập nhật: 2025-04-10 14:00:00

Dự án:
  Mã dự án: 12
  Mã khách hàng: 15
  Tên dự án: Tối ưu SEO ABC
  Mô tả: Cải thiện thứ hạng tìm kiếm Google
  Ngày bắt đầu: 2025-04-01
  Ngày kết thúc: NULL
  Trạng thái: Pending
  Giá trị: 5000000.0
  Ngày tạo: 2025-03-20 11:00:00
  Ngày cập nhật: 2025-03-20 11:00:00

Dự án:
  Mã dự án: 13
  Mã khách hàng: 16
  Tên dự án: App Đặt hàng Mobile
  Mô tả: Xây dựng ứng dụng đặt hàng cho SME
  Ngày bắt đầu: 2025-04-15
  Ngày kết thúc: 2025-09-30
  Trạng thái: InProgress
  Giá trị: 30000000.0
  Ngày tạo: 2025-03-25 09:00:00
  Ngày cập nhật: 2025-05-01 12:00:00

Dự án:
  Mã dự án: 14
  Mã khách hàng: 17
  Tên dự án: Tái thiết kế UI XYZ
  Mô tả: Cải thiện giao diện hệ thống quản lý
  Ngày bắt đầu: 2025-03-10
  Ngày kết thúc: 2025-05-15
  Trạng thái: Completed
  Giá trị: 10000000.0
  Ngày tạo: 2025-03-01 13:00:00
  Ngày cập nhật: 2025-05-15 16:00:00

Dự án:
  Mã dự án: 15
  Mã khách hàng: 18
  Tên dự án: Website Portfolio
  Mô tả: Tạo website cá nhân giới thiệu
  Ngày bắt đầu: 2025-04-10
  Ngày kết thúc: 2025-06-30
  Trạng thái: InProgress
  Giá trị: 7000000.0
  Ngày tạo: 2025-04-01 08:00:00
  Ngày cập nhật: 2025-05-01 10:00:00

Dự án:
  Mã dự án: 16
  Mã khách hàng: 19
  Tên dự án: Hệ thống CRM Hitech
  Mô tả: Phát triển CRM tùy chỉnh
  Ngày bắt đầu: 2025-05-01
  Ngày kết thúc: NULL
  Trạng thái: Pending
  Giá trị: 25000000.0
  Ngày tạo: 2025-04-20 14:00:00
  Ngày cập nhật: 2025-04-20 14:00:00

Dự án:
  Mã dự án: 17
  Mã khách hàng: 20
  Tên dự án: App Quản lý K Solutions
  Mô tả: Ứng dụng quản lý doanh nghiệp
  Ngày bắt đầu: 2025-05-10
  Ngày kết thúc: 2025-10-31
  Trạng thái: InProgress
  Giá trị: 35000000.0
  Ngày tạo: 2025-04-25 12:00:00
  Ngày cập nhật: 2025-05-05 15:00:00

Dự án:
  Mã dự án: 18
  Mã khách hàng: 21
  Tên dự án: Website Công ty L Tech
  Mô tả: Thiết kế website công ty công nghệ
  Ngày bắt đầu: 2025-05-15
  Ngày kết thúc: 2025-07-31
  Trạng thái: InProgress
  Giá trị: 12000000.0
  Ngày tạo: 2025-05-01 09:00:00
  Ngày cập nhật: 2025-05-10 11:00:00

Dự án:
  Mã dự án: 19
  Mã khách hàng: 22
  Tên dự án: Hệ thống Bán lẻ N Retail
  Mô tả: Xây dựng hệ thống quản lý bán lẻ
  Ngày bắt đầu: 2025-05-20
  Ngày kết thúc: NULL
  Trạng thái: Pending
  Giá trị: 18000000.0
  Ngày tạo: 2025-05-03 10:00:00
  Ngày cập nhật: 2025-05-03 10:00:00

Dự án:
  Mã dự án: 20
  Mã khách hàng: 23
  Tên dự án: Website Truyền thông O Media
  Mô tả: Tạo website cho công ty truyền thông
  Ngày bắt đầu: 2025-05-10
  Ngày kết thúc: 2025-08-31
  Trạng thái: InProgress
  Giá trị: 15000000.0
  Ngày tạo: 2025-05-04 13:00:00
  Ngày cập nhật: 2025-05-06 14:00:00


Tổng số dự án: 11"
    ],

    // Prompt về thống kê
    'statistics' => [
        'role' => 'system',
        'content' => "Thống kê hệ thống:
- Tổng số khách hàng: {total_customers}
- Tổng số dự án: {total_projects}
- Tổng số tương tác: {total_interactions}
- Doanh thu tháng này: {monthly_revenue}
- Doanh thu năm nay: {yearly_revenue}"
    ],

    // Prompt về hướng dẫn sử dụng
    'help' => [
        'role' => 'system',
        'content' => "Hướng dẫn sử dụng:
1. Để xem danh sách khách hàng, hãy yêu cầu 'hiển thị danh sách khách hàng'
2. Để thêm khách hàng mới, hãy yêu cầu 'thêm khách hàng mới' và làm theo hướng dẫn
3. Để xem chi tiết khách hàng, hãy yêu cầu 'xem chi tiết khách hàng [tên/mã]'
4. Để cập nhật thông tin khách hàng, hãy yêu cầu 'cập nhật thông tin khách hàng [tên/mã]'
5. Để xóa khách hàng, hãy yêu cầu 'xóa khách hàng [tên/mã]'
6. Để thêm tương tác, hãy yêu cầu 'thêm tương tác với khách hàng [tên/mã]'
7. Để xem lịch sử tương tác, hãy yêu cầu 'xem lịch sử tương tác với khách hàng [tên/mã]'"
    ],

    // Prompt về xử lý lỗi
    'error' => [
        'role' => 'system',
        'content' => "Khi gặp lỗi, hãy:
1. Thông báo lỗi một cách rõ ràng và thân thiện
2. Đề xuất các giải pháp khả thi
3. Hướng dẫn người dùng cách khắc phục
4. Nếu cần, yêu cầu người dùng cung cấp thêm thông tin"
    ],

    // Prompt về phản hồi
    'response' => [
        'role' => 'system',
        'content' => "Khi trả lời, hãy:
1. Sử dụng ngôn ngữ thân thiện, chuyên nghiệp
2. Cung cấp thông tin đầy đủ và chính xác
3. Định dạng câu trả lời rõ ràng, dễ đọc
4. Đề xuất các bước tiếp theo phù hợp
5. Luôn cập nhật thời gian hiện tại trong câu trả lời nếu có liên quan"
    ]
];