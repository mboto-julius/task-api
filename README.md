# Laravel Task Management API

A RESTful Task Management API built with Laravel, serving as the backend for a Flutter mobile application. It enables users to authenticate and manage tasks, subtasks, and daily logs efficiently.

---

## Features

- User Registration (with password confirmation)
- User Login & Logout
- Token-based Authentication via Laravel Sanctum
- Full CRUD for Tasks, Subtasks, and Daily Logs
- Daily Log tracking (start time, end time, description)
- Task Status Management
- Request Validation & JSON API Responses
- Ownership-based Authorization

---

## Technology Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 13 |
| Language | PHP 8.x |
| Database | MySQL |
| Authentication | Laravel Sanctum |
| API Style | RESTful |

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/mboto-julius/task-api.git
cd task-api
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Create Environment File

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Configure Database

Update your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_api
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Install Laravel Sanctum

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

### 8. Start the Development Server

```bash
php artisan serve
```

The API will be available at:

```
http://127.0.0.1:8000/api
```

---

## Authentication

This API uses **Laravel Sanctum** for token-based authentication. After a successful login, include the returned token in all subsequent request headers:

```
Authorization: Bearer {token}
```

---

## API Endpoints

### Authentication

| Method | Endpoint | Description | Auth Required |
|---|---|---|---|
| `POST` | `/api/register` | Register a new user | No |
| `POST` | `/api/login` | Login and receive token | No |
| `POST` | `/api/logout` | Logout and revoke token | Yes |

### Tasks

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/tasks` | Get all tasks |
| `POST` | `/api/tasks` | Create a new task |
| `GET` | `/api/tasks/{id}` | Get a single task |
| `PUT` | `/api/tasks/{id}` | Update a task |
| `DELETE` | `/api/tasks/{id}` | Delete a task |

### Subtasks

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/tasks/{task}/subtasks` | Get all subtasks for a task |
| `POST` | `/api/tasks/{task}/subtasks` | Create a subtask |
| `GET` | `/api/subtasks/{id}` | Get a single subtask |
| `PUT` | `/api/subtasks/{id}` | Update a subtask |
| `DELETE` | `/api/subtasks/{id}` | Delete a subtask |

### Daily Logs

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/subtasks/{subtask}/logs` | Get all logs for a subtask |
| `POST` | `/api/subtasks/{subtask}/logs` | Create a log entry |
| `GET` | `/api/logs/{id}` | Get a single log |
| `PUT` | `/api/logs/{id}` | Update a log |
| `DELETE` | `/api/logs/{id}` | Delete a log |

> All task, subtask, and daily log endpoints require authentication (`Authorization: Bearer {token}`).

---

## Example Requests

### Register

```http
POST /api/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "secret123",
  "password_confirmation": "secret123"
}
```

### Login

```http
POST /api/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "secret123"
}
```

---

## Support

For support or inquiries, feel free to reach out:

📞 **+255 692 484 614**