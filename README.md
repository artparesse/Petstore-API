# Petstore API Integration

A Laravel-based application for integrating with the Petstore API. This guide provides the necessary steps to set up and run the project.

## Requirements
Ensure you have the following installed on your system:
- **PHP** (>= 8.2)
- **Composer**
- **Node.js** & **npm**
- **Docker** (optional, for Laravel Sail)

---

## Setup Instructions

Follow these steps to set up the project locally:

### 1. Clone the repository
```bash
git clone <repository-url>
cd <repository-folder>
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Configure environment settings
```bash
cp .env.example .env
```

### 4. Generate an application key
```bash
php artisan key:generate
```

### 5. Install Node.js dependencies
```bash
npm install
```

### 6. Build assets
```bash
npm run build
```

---

## Running the Application

### Using Docker (Recommended)
If you're using Docker and Laravel Sail, start the container:
```bash
./vendor/bin/sail up -d
```

### Using Local Environment
Run the application using Laravel's built-in server:
```bash
php artisan serve
```
