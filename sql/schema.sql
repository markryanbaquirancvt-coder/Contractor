CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contractors (
    contractor_id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(100),
    contractor_name VARCHAR(100),
    contact_number VARCHAR(50),
    specialization VARCHAR(100),
    email VARCHAR(100),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(100),
    budget DECIMAL(15, 2),
    contractor_id INT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (contractor_id) REFERENCES contractors(contractor_id) ON DELETE CASCADE
);

CREATE TABLE activity_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    operation VARCHAR(50),
    contractor_id INT,
    done_by VARCHAR(50),
    description TEXT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
