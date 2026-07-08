# Discuss Project

A community-driven **Q&A discussion forum** where users can ask questions, share answers, and engage in topic-based discussions. Built with vanilla PHP and MySQL.

---

## Features

### User Management
- **Registration & Login** — Secure sign-up with bcrypt password hashing and session-based authentication
- **Profile** — Each user has a username, email, and address associated with their account

### Questions
- **Ask Questions** — Authenticated users can post questions with a title, detailed description, and category
- **Browse & Filter** — View all questions, filter by category, view your own questions, or see the latest ones
- **Search** — Full-text search across question titles
- **Delete** — Users can remove their own questions

### Answers
- **Post Answers** — Authenticated users can contribute answers to any question
- **Related Questions** — Each question page shows related questions from the same category

### Categories
- Pre-defined categories help organize questions and make browsing intuitive
- Category sidebar for quick navigation

### UI / UX
- **Responsive Design** — Bootstrap 5-powered layout works on desktop and mobile
- **Flash Messages** — Success/error notifications with dismissible alerts
- **Search Bar** — Always accessible from the navigation bar

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | PHP (vanilla, no framework) |
| **Database** | MySQL via MySQLi |
| **Frontend** | HTML5, CSS3, Bootstrap 5.0.2 (CDN) |
| **Server** | Apache (XAMPP) |
| **Auth** | Session-based with `password_hash()` / `password_verify()` |

---

## Getting Started

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) (or any Apache + PHP + MySQL stack)

### Installation

1. **Clone or copy** the project into your web server's document root:

   ```bash
   git clone https://github.com/your-username/ToDoList.git
   # or copy the folder to C:\xampp\htdocs\ToDoList
   ```

2. **Start Apache and MySQL** via the XAMPP Control Panel.

3. **Create the database** — Open phpMyAdmin (`http://localhost/phpmyadmin`) or the MySQL CLI and run:

   ```sql
   CREATE DATABASE discuss;
   USE discuss;

   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(255) NOT NULL,
       email VARCHAR(255) NOT NULL,
       password VARCHAR(255) NOT NULL,
       address TEXT
   );

   CREATE TABLE category (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL
   );

   CREATE TABLE questions (
       id INT AUTO_INCREMENT PRIMARY KEY,
       title VARCHAR(255) NOT NULL,
       description TEXT,
       category_id INT,
       user_id INT,
       FOREIGN KEY (category_id) REFERENCES category(id),
       FOREIGN KEY (user_id) REFERENCES users(id)
   );

   CREATE TABLE answers (
       id INT AUTO_INCREMENT PRIMARY KEY,
       answer TEXT,
       question_id INT,
       user_id INT,
       FOREIGN KEY (question_id) REFERENCES questions(id),
       FOREIGN KEY (user_id) REFERENCES users(id)
   );
   ```

4. **(Optional) Seed categories:**

   ```sql
   INSERT INTO category (name) VALUES ('Technology'), ('Science'), ('Education'), ('Health'), ('Sports');
   ```

5. **Configure database connection** — Update credentials in `common/db.php` if needed (defaults: `root` with no password).

6. **Open your browser** and go to:

   ```
   http://localhost/ToDoList
   ```

---

## Project Structure

```
ToDoList/
├── index.php                 # Front controller / router
├── client/                   # View layer (UI files)
│   ├── header.php            # Navigation bar, search, alerts
│   ├── signup.php            # Registration form
│   ├── login.php             # Login form
│   ├── ask.php               # Ask a question form
│   ├── questions.php         # Question listing
│   ├── question-details.php  # Single question with answers
│   ├── answers.php           # Answer display
│   ├── category.php          # Category dropdown
│   ├── categorylist.php      # Category sidebar
│   └── commonfiles.php       # Bootstrap / CSS includes
├── server/
│   └── requests.php          # All POST/GET request handlers
├── common/
│   └── db.php                # Database connection
└── public/
    ├── style.css             # Custom styles
    └── logo.png              # Brand logo
```

---

## Database Configuration

All database settings are in **`common/db.php`**:

```php
$host     = "localhost";
$username = "root";
$password = "";
$database = "discuss";
```

---

## Security Notes

- Passwords are hashed using `PASSWORD_BCRYPT` via `password_hash()`.
- `INSERT` queries use prepared statements with bound parameters.
- Some `SELECT` and `DELETE` queries currently interpolate user input directly — review and parameterize these before deploying to production.

---

## License

This project is open source and available under the [MIT License](LICENSE).
