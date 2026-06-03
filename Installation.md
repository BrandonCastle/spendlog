# Installation Guide

## Requirements

- Raspberry Pi Zero 2W running Raspberry Pi OS (32-bit)
- Internet connection for initial setup

## Steps

### 1. Update the system

    sudo apt update && sudo apt upgrade -y

### 2. Install Apache, PHP, and MariaDB

    sudo apt install apache2 php libapache2-mod-php php-mysql mariadb-server -y

### 3. Secure MariaDB

    sudo mysql_secure_installation

Follow the prompts — set a root password and remove anonymous users.

### 4. Create the database

    sudo mysql -u root -p

Then run the following SQL:

    CREATE DATABASE spendlog;
    USE spendlog;

    CREATE TABLE categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL
    );

    CREATE TABLE expenses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        amount DECIMAL(15,2) NOT NULL,
        description VARCHAR(255),
        category_id INT,
        date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id)
    );

    CREATE TABLE members (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_id VARCHAR(20) NOT NULL,
        name VARCHAR(100) NOT NULL,
        bio TEXT
    );

    INSERT INTO categories (name) VALUES ('Food'),('Transport'),('Utilities'),('Entertainment'),('Other');

    CREATE USER 'spendlog'@'localhost' IDENTIFIED BY 'spendlog123';
    GRANT ALL PRIVILEGES ON spendlog.* TO 'spendlog'@'localhost';
    FLUSH PRIVILEGES;
    EXIT;

### 5. Copy project files

    sudo cp -r spendlog/ /var/www/html/

### 6. Done

Access the app at http://your-pi-ip/spendlog/
