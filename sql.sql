-- Tạo bảng users
-- Tạo bảng users
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    email VARCHAR(100),
    password_hash VARCHAR(255),
    created_at DATETIME
);

-- Tạo bảng customers (đã thêm birthday)
CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    company VARCHAR(100),
    address VARCHAR(255),
    notes TEXT,
    source VARCHAR(50),
    status VARCHAR(50),
    tags VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    avatar_url VARCHAR(255) DEFAULT 'avatar.png',
    birthday DATE
);

-- Tạo bảng interactions
CREATE TABLE interactions (
    interaction_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    interaction_type VARCHAR(50),
    interaction_date DATETIME,
    summary TEXT,
    created_by INT,
    created_at DATETIME,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
    FOREIGN KEY (created_by) REFERENCES users(user_id)
);

-- Tạo bảng projects
CREATE TABLE projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    project_name VARCHAR(255),
    description TEXT,
    start_date DATE,
    end_date DATE,
    status VARCHAR(50),
    value DECIMAL(15, 2),
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

-- Tạo bảng contact_submissions
CREATE TABLE contact_submissions (
    submission_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    subject VARCHAR(255),
    message TEXT,
    submission_date DATETIME,
    is_read BOOLEAN DEFAULT FALSE,
    status VARCHAR(50)
);

-- Tạo bảng site_content
CREATE TABLE site_content (
    content_id INT AUTO_INCREMENT PRIMARY KEY,
    content_key VARCHAR(100),
    content_value TEXT,
    last_updated DATETIME
);

INSERT INTO users (username, email, password_hash, created_at) VALUES
('admin', 'admin@example.com', '$2y$10$eCZjrKgSVuECJO80W7adQeSZrcPahYmkyE1UiE.IPrUB7Xezqi57i', '2024-06-01 09:00:00'),
('staff2', 'staff2@example.com', '$2y$10$eCZjrKgSVuECJO80W7adQeSZrcPahYmkyE1UiE.IPrUB7Xezqi57i', '2024-06-05 14:30:00'),
('manager3', 'manager3@example.com', '$2y$10$eCZjrKgSVuECJO80W7adQeSZrcPahYmkyE1UiE.IPrUB7Xezqi57i', '2024-06-10 10:15:00');
-- pass is 123456 --
INSERT INTO customers (name, email, phone, company, address, notes, source, status, tags, created_at, updated_at, avatar_url, birthday) VALUES
('Nguyen Van A', 'nva@example.com', '0901234567', 'TechCorp', '123 Le Loi St, District 1, Ho Chi Minh City', 'New client, interested in CRM solutions', 'Website', 'Potential', 'tech,CRM', '2025-01-15 08:00:00', '2025-06-10 15:00:00', 'avatar.png', '1990-03-15'),
('Tran Thi B', 'ttb@example.com', '0912345678', 'RetailShop', '456 Tran Phu St, Hai Phong', 'Follow up on payment terms', 'Referral', 'Active', 'retail', '2025-02-20 09:30:00', '2025-06-15 11:00:00', 'avatar.png', '1985-07-22'),
('Le Van C', 'lvc@example.com', '0923456789', 'LogiCo', '789 Nguyen Trai St, Hanoi', 'Needs logistics software demo', 'LinkedIn', 'Potential', 'logistics', '2025-03-01 13:00:00', '2025-06-20 14:00:00', 'avatar.png', '1982-11-10'),
('Pham Thi D', 'ptd@example.com', '0934567890', NULL, '101 Hai Ba Trung St, Da Nang', 'Interested in web design', 'Event', 'Active', 'design', '2025-04-05 10:00:00', '2025-06-22 09:00:00', 'avatar.png', '1995-04-18'),
('Hoang Van E', 'hve@example.com', '0945678901', 'MediaPro', '321 Hung Vuong St, Can Tho', 'VIP client, long-term contract', 'Website', 'Active', 'VIP,media', '2025-05-10 11:30:00', '2025-06-23 16:00:00', 'avatar.png', '1988-09-05');

INSERT INTO interactions (customer_id, interaction_type, interaction_date, summary, created_by, created_at) VALUES
(1, 'Email', '2025-06-01 09:00:00', 'Sent welcome email and service details', 1, '2025-06-01 09:05:00'),
(1, 'Call', '2025-06-05 14:00:00', 'Discussed CRM features', 1, '2025-06-05 14:05:00'),
(2, 'Meeting', '2025-06-10 10:00:00', 'Reviewed payment terms', 2, '2025-06-10 10:15:00'),
(3, 'Email', '2025-06-15 11:00:00', 'Sent logistics demo link', 1, '2025-06-15 11:10:00'),
(4, 'Call', '2025-06-20 14:00:00', 'Follow up on web design proposal', 3, '2025-06-20 14:10:00');

INSERT INTO projects (customer_id, project_name, description, start_date, end_date, status, value, created_at, updated_at) VALUES
(1, 'CRM Implementation', 'Develop custom CRM system', '2025-06-01', '2025-12-01', 'InProgress', 25000000.00, '2025-05-15 08:00:00', '2025-06-10 15:00:00'),
(2, 'Retail Store App', 'Mobile app for retail management', '2025-06-05', '2025-11-30', 'InProgress', 18000000.00, '2025-05-20 09:30:00', '2025-06-15 11:00:00'),
(3, 'Logistics Software', 'Custom logistics tracking system', '2025-06-10', '2025-10-15', 'Pending', 30000000.00, '2025-05-25 13:00:00', '2025-06-20 14:00:00'),
(4, 'Web Design Project', 'Design responsive website', '2025-06-15', '2025-09-01', 'InProgress', 12000000.00, '2025-06-01 10:00:00', '2025-06-22 09:00:00'),
(5, 'Media Campaign Site', 'Website for media campaign', '2025-06-20', '2025-12-31', 'Pending', 15000000.00, '2025-06-05 11:30:00', '2025-06-23 16:00:00');

INSERT INTO contact_submissions (name, email, phone, subject, message, submission_date, is_read, status) VALUES
('Nguyen Van F', 'nvf@example.com', '0956789012', 'Inquiry about CRM', 'Need details on CRM pricing', '2025-06-01 08:30:00', TRUE, 'Pending'),
('Tran Thi G', 'ttg@example.com', '0967890123', 'Web Design Quote', 'Requesting quote for website', '2025-06-05 14:15:00', FALSE, 'New'),
('Le Van H', 'lvh@example.com', '0978901234', 'Support Request', 'Need help with login', '2025-06-10 09:45:00', TRUE, 'Resolved'),
('Pham Thi I', 'pti@example.com', '0989012345', 'Partnership', 'Interested in partnership', '2025-06-15 11:20:00', FALSE, 'New'),
('Hoang Van J', 'hvj@example.com', '0990123456', 'Feedback', 'Great service, thanks!', '2025-06-20 13:30:00', TRUE, 'Completed');

INSERT INTO site_content (content_key, content_value, last_updated) VALUES
('home_welcome', 'Welcome to our CRM platform!', '2025-06-01 10:00:00'),
('about_us', 'We provide innovative CRM solutions.', '2025-06-05 15:00:00'),
('services', 'Services include CRM, web design, and logistics.', '2025-06-10 12:00:00'),
('contact_info', 'Contact us at support@example.com', '2025-06-15 14:00:00'),
('privacy_policy', 'Our privacy policy ensures data security.', '2025-06-20 16:00:00'),
('terms_of_service', 'Terms of service apply to all users.', '2025-06-25 09:00:00'),
('faq', 'Frequently Asked Questions about our services.', '2025-06-30 11:00:00'),
('blog', 'Latest news and updates from our team.', '2025-07-05 13:00:00'),
('testimonials', 'What our clients say about us.', '2025-07-10 15:00:00'),
('careers', 'Join our team and grow with us!', '2025-07-15 17:00:00');

ALTER TABLE site_content
ADD COLUMN is_active BOOLEAN DEFAULT 0;

