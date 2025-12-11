# BeautyFly Aura 🌸

BeautyFly Aura is a premium skincare e-commerce application built with Laravel. It features a modern, responsive design and a comprehensive admin panel for managing products, reviews, and orders.

## 🚀 Project Overview

- **Frontend**: Beautiful, responsive customer interface with product filtering, search, and reviews.
- **Backend**: Laravel-powered admin panel for full content management.
- **Features**:
    - Product browsing with category filters and sorting.
    - AJAX-powered live search.
    - User authentication (Registration/Login).
    - Shopping cart and checkout system.
    - Customer reviews with image uploads.
    - Admin panel for managing Products, Categories, Reviews, Orders, and Users.

## 🛠️ Setup Instructions

Follow these steps to set up the project locally:

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL

### Installation

1.  **Clone the repository** (if applicable) or navigate to the project directory.

2.  **Install PHP dependencies**:
    ```bash
    composer install
    ```

3.  **Install Node.js dependencies** (for styling/assets):
    ```bash
    npm install
    npm run build
    ```

4.  **Environment Configuration**:
    - Copy `.env.example` to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Update your database credentials in `.env`:
      ```env
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=beautyfly_aura
      DB_USERNAME=root
      DB_PASSWORD=
      ```

5.  **Generate Application Key**:
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations & Seeders**:
    ```bash
    php artisan migrate --seed
    ```

7.  **Link Storage**:
    ```bash
    php artisan storage:link
    ```

8.  **Start the Development Server**:
    ```bash
    php artisan serve
    ```

    The application will be available at `http://localhost:8000`.

## 📖 Usage Guide

### Customer Features
- **Browse Products**: Visit the home page or products page to view skincare items.
- **Search**: Use the search bar in the products page to find items by name or category.
- **Filter**: Filter products by skin type using the dropdown.
- **Reviews**: Log in to leave reviews on products. You can upload a photo with your review!
- **Cart**: Add items to your cart and proceed to checkout.

### Admin Features
- **Access**: Log in with an admin account (set `is_admin` to 1 in the users table).
- **Dashboard**: View key metrics.
- **Products**: Create, read, update, and delete products.
- **Reviews**: Manage customer reviews. You can edit reviews and delete inappropriate ones.
- **Orders**: View and manage customer orders.

## 🔌 API Documentation

The application exposes the following API endpoints:

- `GET /api/products`: List all products (paginated).
- `GET /api/products/{id}`: Get details of a specific product.

---

**BeautyFly Aura** - Premium Skincare for You.
