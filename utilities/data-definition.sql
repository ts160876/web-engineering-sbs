/* This file creates the database tables. */

/* Database for bukubuku */
CREATE DATABASE bukubuku;
USE bukubuku;

/* Table for users 
   Columns: user_id, first_name, last_name, email, pwd, is_admin
*/ 
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    pwd VARCHAR(100),
    is_admin BOOLEAN
);

/* Table for books 
   Columns: book_id, title, author, isbn, published, pages, format, status
*/
CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    author VARCHAR(100),
    isbn VARCHAR(100),
    published DATE,
    pages INT, 
    format ENUM ('audio_book', 'hardcover', 'kindle', 'mp3'),
    checkout_status ENUM ('available', 'checked_out'),
    INDEX index_isbn (isbn)
);

/* Table for checkouts
   Columns: checkout_id, user_id, book_id, start_time, end_time
*/
CREATE TABLE checkouts (
    checkout_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    start_time TIMESTAMP NULL,
    end_time TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id)
);

/* Show databases and tables. */
SHOW DATABASES;
SHOW TABLES;

/* Describe the tables. */
DESCRIBE users;
DESCRIBE books;
DESCRIBE checkouts;