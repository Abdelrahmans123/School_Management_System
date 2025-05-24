# School Management System

A robust, multilingual, role-based School Management System built using Laravel, Livewire, and MySQL. This system facilitates efficient management of school operations for different user roles including Admins, Teachers, Students, and Parents. It also integrates with the Zoom API to support online sessions.

---

## Features

- **Role-Based Access:** Multi-authentication for Admin, Teacher, Student, and Parent roles using Laravel Guards.
- **Secure Authentication:** JWT-based and session authentication with middleware protection.
- **Dashboard Routing:** Dynamic redirection to role-specific dashboards after login.
- **Livewire Integration:** Real-time UI updates for interactive features using Livewire.
- **Multilingual Support:** Full localization using `mcamara/laravel-localization`.
- **Zoom Integration:** Create and manage online classes through OAuth-secured Zoom API.
- **Task Modules:** Manage grades, sections, subjects, attendance, fees, library, profiles, and exam sessions.
- **File Management:** Upload, download, and delete attachments with student profiles.
- **Responsive Design:** Mobile-friendly UI using Blade and Livewire components.

---

## Technologies Used

- **Backend:** Laravel 10, PHP 8+
- **Frontend:** Blade Templates, Livewire 3
- **Database:** MySQL
- **API Integration:** Zoom API
- **Localization:** Laravel Localization (mcamara/laravel-localization)

---

## Installation
1. Clone the repository
```bash
git clone https://github.com/Abdelrahmans123/InvoiceManagementSystem.git
```
2. Navigate to the directory
```bash
cd InvoiceManagementSystem
```
3. Install dependencies
```bash
composer install
```
4. Set up your .env file. You can copy the .env.example to .env
```bash
copy .env.example .env
```
5. Set up your database connection in the .env file by updating the database settings
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_management_system
DB_USERNAME=root
DB_PASSWORD=
```
6. Generate the application key
```bash
php artisan key:generate
```
7. Run database migrations to create the necessary tables
```bash
php artisan migrate
```
8. Seed database
```bash
php artisan db:seed
```
9. Start the Laravel development server
```bash
php artisan serve
```
This will start the server at http://127.0.0.1:8000.
## Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your changes.
## License
This project is licensed under the MIT License.
## Support
For support or inquiries, please contact [sabdelrahman110@gmail.com](mailto:sabdelrahman110@gmail.com).

