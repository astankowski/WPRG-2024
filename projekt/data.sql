CREATE DATABASE blog;

USE blog;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(50) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL,
                       role ENUM('admin', 'author', 'user') NOT NULL
);

CREATE TABLE posts (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       title VARCHAR(255) NOT NULL,
                       content TEXT NOT NULL,
                       image VARCHAR(255) DEFAULT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comments (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          post_id INT NOT NULL,
                          username VARCHAR(50) NOT NULL,
                          content TEXT NOT NULL,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

INSERT INTO `posts` (`title`, `content`, `image`, `created_at`) VALUES
    ('First Blog Post', 'This is the content of the first blog post. Welcome to our blog!', NULL, '2024-06-28 10:00:00');

INSERT INTO `posts` (`title`, `content`, `image`, `created_at`) VALUES
    ('Second Blog Post', 'Here is some interesting information in our second blog post.', 'image1.jpg', '2024-06-29 12:00:00');

INSERT INTO `posts` (`title`, `content`, `image`, `created_at`) VALUES
    ('Third Blog Post', 'The third post discusses various topics of interest.', 'image2.jpg', '2024-06-30 14:00:00');
