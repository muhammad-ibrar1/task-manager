# Laravel Task Manager 
A simple task management application built with **Laravel**, **Bootstrap**, and **Docker**.


##  Features

- Create, update, delete tasks
- Assign tasks to a project
- Reorder tasks with drag-and-drop (priority updates automatically)
- Manage projects with full CRUD interface
- Filter tasks by project
- Built with Laravel 11, MySQL 8, and PHP 8.2

##  Setup Instructions (Docker-based)

```bash
git clone https://github.com/muhammad-ibrar1/task-manager.git
cd task-manager


# Start Docker containers
docker-compose up -d --build

# Enter the PHP container
docker exec -it laravel-app bash

#Install Laravel & prepare environment
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate