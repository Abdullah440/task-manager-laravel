# 📝 Task Manager Web App

A simple and responsive Task Manager built with **Laravel**, **Bootstrap**, and **jQuery**. This app allows users to create, update, delete, and sort tasks with drag-and-drop functionality — no login required.

---

## 🚀 Features

- ✅ Create, update, and delete tasks
- ✅ Status management: To Do, In Progress, Done
- ✅ AJAX-based task status updates (jQuery)
- ✅ Drag-and-drop task sorting with Sortable.js
- ✅ Color indicators based on task status
- ✅ Mobile responsive using Bootstrap 5

---

## 🧑‍💻 Tech Stack

- PHP 8+ / Laravel 12
- MySQL 
- Bootstrap 5
- jQuery + Sortable.js

---

## ⚙️ Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/Abdullah440/task-manager-laravel.git
cd task-manager-laravel
```

### 2. Install PHP dependencies
```bash
composer install
```
### 3. Copy .env file and generate app key
```bash
cp .env.example .env
php artisan key:generate
```
### 4. Configure your .env file
```bash
# Open `.env` in a text editor and update these lines with your database details:
# For example:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=task_manager
# DB_USERNAME=YOUR_DATABASE_USERNAME
# DB_PASSWORD=YOUR_DATABASE_PASSWORD
```
### 5. Run database migrations
```bash
php artisan migrate
```
### 6. (Optional) Set correct permissions for storage and bootstrap/cache
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```
### 7. Start Laravel development server
```bash
php artisan serve
```
