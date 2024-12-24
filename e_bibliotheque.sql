DROP DATABASE IF EXISTS biblio_db;

CREATE DATABASE biblio_db;

USE biblio_db;

-- Table users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'etudiant') DEFAULT 'etudiant'
);

INSERT INTO users(username, password, role) VALUES("admin", "$2y$10$Xfdi8H7KEtqbBR6aHo2vUu5UrtIqD3c9f1IM65CoBnP/cDBWRKNFy", "admin");

-- Table books
CREATE TABLE books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    image_name varchar(200) DEFAULT NULL,
    available BOOLEAN NOT NULL DEFAULT 1
);

-- Table rentals
CREATE TABLE rentals (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    rented_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    returned_at DATETIME DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);
