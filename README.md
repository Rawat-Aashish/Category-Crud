# Categories and Subcategories CRUD with Sanctum Authentication

This repository implements a simple Laravel application for managing categories and subcategories. The application includes CRUD (Create, Read, Update, Delete) functionality for categories and subcategories, with authentication handled by Laravel Sanctum.

## Features

- User authentication using Laravel Sanctum.
- CRUD operations for:
  - Categories
  - Subcategories (with relationships to categories).
- Role-based access to APIs (e.g., only authenticated users can manage categories/subcategories).

## API Endpoints

### Authentication

- **Register**: `POST /api/sign-in`
- **Login**: `POST /api/login`
- **Forgot-password**: `POST /api/forgot-password`
- **Change-password**: `POST /api/change-password/{user}`

### Categories

- **View Categories**: `GET /api/category/list`
- **Create Category**: `POST /api/category/create`
- **Update Category**: `POST /api/category/{id}/update`
- **Delete Category**: `DELETE /api/category/{id}/delete`

### Subcategories

- **View Subcategory**: `GET /api/sub-category/list`
- **Create Subcategory**: `POST /api/sub-category/create`
- **Update Subcategory**: `POST /api/sub-category/{id}/update`
- **Delete Subcategory**: `DELETE /api/sub-category/{id}/delete`
