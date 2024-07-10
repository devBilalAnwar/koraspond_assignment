# User Authentication and Product Management Microservice

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
  </a>
</p>

<p align="center">
  <a href="https://travis-ci.org/laravel/framework">
    <img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

## Overview

This microservice, built with Laravel, provides user authentication and product management functionalities. It includes endpoints for user registration, login, logout, and role-based access control for managing products.

## Requirements

- PHP 8.x
- Composer
- MySQL or another supported database
- Laravel 9.x

## Setup

### 1. Clone the Repository


git clone 


2. Install Dependencies

composer install

3. Set Environment Configuration
Copy the .env.example file to .env:

<b> cp .env.example .env</b>


Update the .env file with your database credentials and other necessary configurations.


4. Generate Application Key and Run the Migration

php artisan key:generate
php artisan migrate

5. Install Laravel Sanctum

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

6. Start the Development Server
php artisan serve


API Endpoints

Authentication

Register: POST /api/register

Request: { "name": "John Doe", "email": "johndoe@example.com", "password": "password" }
Response: { "access_token": "token", "token_type": "Bearer" }
Login: POST /api/login

Request: { "email": "johndoe@example.com", "password": "password" }
Response: { "access_token": "token", "token_type": "Bearer" }
Logout: POST /api/logout

Headers: Authorization: Bearer {token}
Response: { "message": "Successfully logged out" }
<!-- ------ -->
Products

List Products: GET /api/products

Headers: Authorization: Bearer {token}
Response: [{ "id": 1, "name": "Product 1", "description": "Description", "price": 10.99, "quantity": 100 }, ...]
Get Product: GET /api/products/{id}

Headers: Authorization: Bearer {token}
Response: { "id": 1, "name": "Product 1", "description": "Description", "price": 10.99, "quantity": 100 }
Create Product: POST /api/products

Headers: Authorization: Bearer {token}
Request: { "name": "New Product", "description": "New Description", "price": 10.99, "quantity": 100 }
Response: { "id": 2, "name": "New Product", "description": "New Description", "price": 10.99, "quantity": 100 }
Update Product: PUT /api/products/{id}

Headers: Authorization: Bearer {token}
Request: { "name": "Updated Product", "description": "Updated Description", "price": 12.99, "quantity": 50 }
Response: { "id": 1, "name": "Updated Product", "description": "Updated Description", "price": 12.99, "quantity": 50 }
Delete Product: DELETE /api/products/{id}

Headers: Authorization: Bearer {token}
Response: { "message": "Product deleted successfully" }


Running Tests

Feature Tests

Feature tests ensure the functionality of authentication and product management endpoints:

<b>php artisan test</b>


## License


This README.md file now reflects the setup, endpoints, and testing information for your Laravel microservice according to the documentation style. Adjust `<repository-url>` and `<repository-directory>` placeholders with your actual repository details.

