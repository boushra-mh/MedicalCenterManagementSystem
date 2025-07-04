# 🏥 Medical Center Management System

## 📋 Project Overview

This is a Laravel-based web application designed to efficiently manage a medical center. It supports **three main user roles** with clearly defined permissions:

- **Admin**: Manages medical specialties and doctors.
- **Doctor**: Views and manages their appointments.
- **Patient (User)**: Browses specialties and doctors, books and manages appointments.

---

## 🚀 Features

### 🔐 Authentication & Authorization

- Multi-guard authentication powered by **Laravel Sanctum** for `admin`, `doctor`, and `patient` guards.
- Role and permission management using **Spatie Laravel Permission**.
- Middleware-protected routes based on roles and permissions.

### 👥 User Roles and Permissions

| Role   | Permissions                 |
|--------|-----------------------------|
| Admin  | `manage_specialties`, `manage_doctors` |
| Doctor | `view_appointment`          |
| User   | `book_appointment`          |

- Roles and permissions are seeded using enums (`UserRole`, `PermissionEnum`) for consistency and type-safety.

---

## 📅 Appointments Module

- Patients can **book appointments** with doctors for predefined time slots.
- Unified daily working schedule for all doctors (e.g., hourly slots between 9:00 AM and 5:00 PM).
- Appointment statuses handled via **PHP Enums**: `Pending`, `Confirmed`, `Canceled`.
- Patients can cancel appointments.
- Doctors can confirm or reject appointments.

---

## 🌐 Multilingual Support

- Application content and specialty names are **translatable** (English & Arabic).
- Built using **Spatie Laravel Translatable**.
- Translation stored in **JSON columns** in the database (e.g., `name` in `specialties` table).

---

## 🧠 Services and Architecture

- Business logic is encapsulated within **Service classes**:
  - `AppointmentService`, `DoctorService`, `SpecialtyService`, etc.
- Uses **Custom Eloquent Scopes** like `byUser()`, `byDoctor()` for clean and reusable query logic.
- Controllers are slim and only coordinate data flow, adhering to **Separation of Concerns (SoC)**.
- **Soft deletes** are enabled for appointments. Methods like `withTrashed()` are used where necessary.
- **Dependency injection** is used to inject services and improve testability and maintainability.

---

## 📣 Events & Notifications

- Event-driven design using Laravel’s **event/listener system**.
- Event: `AppointmentBooked` is dispatched on successful booking.
- Listener sends **email notifications** to both the patient and the doctor.
- Email templates support **multilingual messages**.

---

## 🧪 Testing

- Written with testability in mind.
- Services and controllers are loosely coupled.
- Use **PHPUnit** to write and run tests (`php artisan test`).

---

## 🛠 Technology Stack

- **PHP**: 8.1+
- **Laravel**: 12
- **Laravel Sanctum**: API authentication
- **Spatie Laravel Permission**: Roles & permissions
- **Spatie Laravel Translatable**: Localization
- **MySQL**: Relational database
- **PHPUnit**: Testing framework

---

## 🗂️ Database Schema Overview

| Table              | Description                           |
|--------------------|---------------------------------------|
| `users`            | Patients                              |
| `doctors`          | Doctors                               |
| `admins`           | Admin users                           |
| `specialties`      | Medical specialties (translatable)    |
| `doctor_specialty` | Pivot table for doctor-specialty link |
| `appointments`     | Appointment records                   |
| `roles`            | Roles (Spatie)                        |
| `permissions`      | Permissions (Spatie)                  |
| `model_has_roles`  | Model-role pivot (Spatie)             |
| `model_has_permissions` | Model-permission pivot (Spatie)  |

---

## ⚙️ Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/boushra-mh/MedicalCenterManagementSystem.git
   cd medical-center
