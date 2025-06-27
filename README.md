# Medical Center Management System

## Project Overview

This project is a web application built with Laravel to manage a medical center efficiently. It supports three main user roles with distinct functionalities:

- **Admin**: Manage specialties and doctors.
- **Doctor**: View appointments and manage their schedule.
- **Patient (User)**: Browse specialties and doctors, book and manage appointments.

The system uses Laravel Sanctum for multi-guard authentication, Spatie Laravel Permission for role and permission management, and Spatie Laravel Translatable for multilingual support (English and Arabic). It implements event-driven architecture with events and listeners, and sends email notifications upon key actions like appointment booking.

---

## Features

### Authentication & Authorization

- Multi-guard authentication with Sanctum for Admin, Doctor, and Patient.
- Role-based access control with Spatie Laravel Permission.
- Route protection based on roles and permissions.

### User Roles and Permissions

- **Admin**: Can create, edit, and delete specialties and doctors.
- **Doctor**: Can view their booked appointments.
- **Patient**: Can browse specialties, view doctors, book and cancel appointments.

### Appointments

- Unified working schedule for all doctors with allowed time slots.
- Appointment booking with validation for availability and schedule.
- Appointment cancellation by patients.
- Status management via PHP Enums (Pending, Confirmed, Canceled).

### Multilingual Support

- Specialty names and UI content are translatable in English and Arabic.
- Translations stored in JSON columns using Spatie Laravel Translatable.

### Events and Notifications

- Event triggered on appointment booking (`AppointmentBooked`).
- Listeners send confirmation emails to both patient and doctor.
- Email templates support multilingual content.

### Services and Architecture

- Business logic encapsulated in service classes (AppointmentService, DoctorService, SpecialtyService).
- Clean separation of concerns and dependency injection.

---

## Technology Stack

- PHP 8.1+
- Laravel 12
- Laravel Sanctum (API Authentication)
- Spatie Laravel Permission (Roles & Permissions)
- Spatie Laravel Translatable (Localization)
- MySQL or any relational DB
- PHPUnit for testing

---

## Database Schema (Summary)

| Table             | Description                            |
|-------------------|--------------------------------------|
| users             | Patients                             |
| doctors           | Doctors                             |
| admins            | Admin users                         |
| specialties       | Medical specialties (translatable)  |
| doctor_specialty  | Pivot table for doctor specialties   |
| appointments      | Appointment records                  |
| roles             | Spatie roles                        |
| permissions       | Spatie permissions                  |

---

## Setup Instructions

1. Clone the repository.
2. Run `composer install`.
3. Copy `.env.example` to `.env` and set database and mail configurations.
4. Run `php artisan migrate --seed` to create tables and seed initial data.
5. Run `php artisan serve` to start the development server.
6. Use API tools like Postman to test the endpoints.

---

## API Endpoints Overview

- `/api/patient/register` - Patient registration
- `/api/patient/login` - Patient login
- `/api/doctor/login` - Doctor login
- `/api/admin/login` - Admin login
- Protected routes for managing specialties, doctors, appointments with role-based middleware.

---

## Contribution

Contributions are welcome! Please open issues or submit pull requests for bug fixes or feature suggestions.

---

## License

This project is open-source and licensed under the MIT License.
