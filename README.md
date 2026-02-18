# Urenregistratie Systeem

A comprehensive time registration and project management system built with Laravel 7. This application helps teams track working hours, manage projects, tasks, and employee leave requests.

## Features

- **Project Management**: Create and manage projects with categories, descriptions, and status tracking
- **Task Management**: Organize tasks and project-specific tasks with start/end dates
- **Time Registration**: Track working hours and project time allocation
- **Leave Management**: Handle employee vacation and leave requests (verlof)
- **User Management**: Manage employees with job functions (functie)
- **Categories**: Organize projects and tasks by categories
- **Status Tracking**: Monitor project and task progress (pending, ongoing, completed)

## Requirements

- PHP >= 7.2.5
- Composer
- Node.js & NPM
- MySQL or other supported database
- Web server (Apache/Nginx)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/mattam1234/urenregistratie-systeem.git
   cd urenregistratie-systeem
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Update database configuration**
   
   Edit `.env` file and configure your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=urenregistratie
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Compile assets**
   ```bash
   npm run dev
   # or for production
   npm run production
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

   Visit `http://localhost:8000` in your browser.

## Usage

### Creating Users

You can use the built-in factory routes for testing:

- Create setup user: Visit `/setup`
- Add 10 test users: Visit `/add-users`

### Main Features

- **Projects**: Manage all projects at `/projects/all`
  - View ongoing projects
  - View finished projects
  - Create new projects
  - Edit and update project status

- **Tasks**: Track tasks at `/tasks/ongoing`
  - View pending tasks
  - View completed tasks
  - Assign tasks to projects

- **Categories**: Organize work at `/categories`
  - Create categories for projects and tasks
  - Edit and manage categories

- **Leave Requests**: Handle vacation requests at `/verlof-status`
  - Submit leave requests
  - Track leave status

## Technology Stack

- **Backend**: Laravel 7.x
- **Frontend**: Bootstrap 4, Vue.js 2.6, jQuery
- **Database**: MySQL (configurable)
- **Build Tools**: Laravel Mix, Webpack
- **Authentication**: Laravel UI

## Development

### Available NPM Scripts

```bash
npm run dev          # Development build
npm run watch        # Watch for changes
npm run hot          # Hot module replacement
npm run production   # Production build
```

### Testing

Run PHPUnit tests:
```bash
php artisan test
# or
./vendor/bin/phpunit
```

## Project Structure

- `app/` - Application models and controllers
  - `Categories.php` - Category model
  - `Projects.php` - Project model
  - `Tasks.php` - Task model
  - `ProjectTasks.php` - Project task relationships
  - `functie.php` - Job function model
  - `verlof.php` - Leave request model
- `routes/web.php` - Web routes
- `database/migrations/` - Database migrations
- `resources/views/` - Blade templates
- `public/` - Public assets

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
