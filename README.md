# 📋 Task Management API

A RESTful Task Management API built with **Laravel 11** as part of the **Laravel Mid-Level Technical Assessment**.

The application allows authenticated users to manage their own projects and tasks, providing filtering, searching, pagination, dashboard statistics, and secure authentication using Laravel Sanctum.

---

# 🚀 Features

## Authentication

* Register
* Login
* Logout
* Laravel Sanctum Authentication

## Projects

Each authenticated user can:

* Create Project
* List Projects
* View Project
* Update Project
* Delete Project

Project Status:

* Active
* Completed
* Archived

---

## Tasks

Each project contains multiple tasks.

Users can:

* Create Task
* Update Task
* Delete Task
* List Tasks
* Filter by Status
* Filter by Priority
* Search by Title

Task Priority:

* Low
* Medium
* High

Task Status:

* Todo
* In Progress
* Done

---

## Dashboard

A dashboard endpoint provides:

* Total Projects
* Active Projects
* Total Tasks
* Completed Tasks
* Pending Tasks
* Overdue Tasks

---

# 🛠 Tech Stack

* Laravel 11
* PHP 8.2+
* MySQL
* Laravel Sanctum
* Eloquent ORM
* RESTful API

---

# 🏗 Database Structure

## Users

A user can own multiple projects.

## Projects

Each project belongs to one user.

Each project contains multiple tasks.

## Tasks

Each task belongs to one project.

Relationships:

```text
User
 └── hasMany Projects

Project
 └── hasMany Tasks
```

---

# 📁 Project Structure

The project follows Laravel best practices and includes:

* Form Request Validation
* API Resources
* Service Layer
* Eloquent Relationships
* Pagination
* Soft Deletes
* Proper HTTP Status Codes
* Exception Handling

---

# ⚙ Installation

Clone the repository

```bash
git clone https://github.com/<your-username>/task-management-api.git
```

Move into the project

```bash
cd task-management-api
```

Install dependencies

```bash
composer install
```

Copy the environment file

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Configure your database inside `.env`.

Run migrations

```bash
php artisan migrate
```

Seed the database

```bash
php artisan db:seed
```

Start the server

```bash
php artisan serve
```

The application will be available at:

```text
http://localhost:8000
```

---

# 🗄 Database Configuration

Example MySQL configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=
```

---

# 🔐 Demo User

After running:

```bash
php artisan db:seed
```

Use the following credentials:

Email

```text
ailmohammed@gmail.com
```

Password

```text
Thankyou6
```

---

# 📮 API Endpoints

## Authentication

| Method | Endpoint      |
| ------ | ------------- |
| POST   | /api/register |
| POST   | /api/login    |
| POST   | /api/logout   |

---

## Projects

| Method    | Endpoint           |
| --------- | ------------------ |
| GET       | /api/projects      |
| POST      | /api/projects      |
| GET       | /api/projects/{id} |
| PUT/PATCH | /api/projects/{id} |
| DELETE    | /api/projects/{id} |

---

## Tasks

| Method    | Endpoint        |
| --------- | --------------- |
| GET       | /api/tasks      |
| POST      | /api/tasks      |
| PUT/PATCH | /api/tasks/{id} |
| DELETE    | /api/tasks/{id} |

Supported query parameters:

* status
* priority
* search

Example:

```text
/api/tasks?status=todo&priority=high&search=meeting
```

---

## Dashboard

| Method | Endpoint       |
| ------ | -------------- |
| GET    | /api/dashboard |

---

# 📬 Postman Collection

A Postman collection is included with this project.

Collection Name:

```text
Task Management
```

Import the collection into Postman to test all API endpoints.

---

# 🌱 Database Seeders

The project includes database seeders for creating sample data used during development and testing.

Run:

```bash
php artisan db:seed
```

---

# 📄 Assessment Requirements Covered

* Laravel 11
* REST API
* Laravel Sanctum Authentication
* Projects Module
* Tasks Module
* Dashboard Endpoint
* Resource Classes
* Form Request Validation
* Eloquent Relationships
* Pagination
* Database Seeders
* Factories
* Soft Deletes
* Proper HTTP Status Codes
* Error Handling
* Git Repository
* Postman Collection
* Service Layer

---

# 👨‍💻 Author

Developed by **Ehab Mohammed** for the **Laravel Mid-Level Technical Assessment**.
