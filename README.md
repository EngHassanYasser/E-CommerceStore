# E-Commerce Store (Laravel MVC)

A production-grade Laravel application built using the MVC architecture to manage a scalable e-commerce platform. The system includes secure authentication, role-based access control, payment processing, and asynchronous background tasks,multible languages and currencies.

---
## Overview

This project is a traditional MVC-based e-commerce system where the admin manages products, categories, and orders through a web-based dashboard.

The system focuses on server-rendered views using Laravel Blade, providing a clean and maintainable structure for real-world business applications.

---
## Tech Stack

- Laravel 10
- MySQL
- RESTful API
- Repository Pattern + Service Layer
- Laravel Policies (RBAC)
- Queues, Jobs, Task Scheduling
- WebSockets + Pusher
- Stripe Payment Gateway
- Laravel Socialite (OAuth)
- Multi-currency pricing (USD base)
- Laravel Localization

---

## Architecture

The project follows a layered architecture to isolate responsibilities and ensure maintainability:

Controller → Service → Repository (with interface) → Model

- Controllers handle HTTP layer
- Services contain business logic
- Repositories abstract data access
- Policies enforce authorization rules
- Form Requests handle validation
---Repository interfaces define contracts that decouple repositories from implementations.

## Core Features

- Role-Based Access Control using Policies
- Real-time notifications using WebSockets & Pusher
- Email notifications with database persistence
- Stripe payment integration
- Social login (Google, Facebook, Twitter)
- Multi-currency pricing via external exchange rate API (USD as base)
- Background processing using Queues & Jobs
- Task Scheduling for automated operations
- Multi-language static UI support

---

## Installation

```bash
git clone https://github.com/EngHassanYasser/E-CommerceStore.git
cd E-CommerceStore
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
