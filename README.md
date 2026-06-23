# Laravel Task Management API

A RESTful Task Management API built with Laravel. This API serves as the backend for a Flutter mobile application, allowing users to authenticate and manage their tasks efficiently.

## Features

- User Registration
- User Login & Logout
- Token-based Authentication (Laravel Sanctum)
- Create Tasks
- View Tasks
- Update Tasks
- Delete Tasks
- Task Status Management
- Request Validation
- JSON API Responses

## Technology Stack

- Laravel 13
- PHP 8.x
- MySQL
- Laravel Sanctum
- RESTful API

## Installation

### Clone the Repository

```bash
git clone https://github.com/mboto-julius/task-api.git
cd task-api
```

### Install Dependencies

```bash
composer install
```

### Create Environment File

```bash
cp .env.example .env
```

### Generate Application Key

```bash
php artisan key:generate
```

### Configure Database

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_api
DB_USERNAME=root
DB_PASSWORD=
```

### Run Migrations

```bash
php artisan migrate
```

### Install Sanctum

```bash
php artisan migrate
```

### Start the Server

```bash
php artisan serve
```

The API will be available at:

```
http://127.0.0.1:8000/api
```

## Authentication

The API uses Laravel Sanctum for token-based authentication.

After a successful login, a token is returned and should be included in subsequent requests:

```http
Authorization: Bearer {token}
```

## API Endpoints

### Authentication

| Method | Endpoint | Description |
|----------|----------|-------------|
| POST | /register | Register a new user |
| POST | /login | Login user |
| POST | /logout | Logout authenticated user |

### Tasks

| Method | Endpoint | Description |
|----------|----------|-------------|
| GET | /tasks | Get all tasks |
| POST | /tasks | Create a task |
| GET | /tasks/{id} | Get a single task |
| PUT | /tasks/{id} | Update a task |
| DELETE | /tasks/{id} | Delete a task |



