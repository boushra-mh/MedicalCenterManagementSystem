# 🏥 Medical Center Management System

## 📋 Project Overview

This is a **Laravel 12** based web application designed to efficiently manage a medical center with full multi-role access and dynamic appointment handling.  
The system supports **three user roles**, each with their own dashboard and feature set:

- **Admin**: Manages specialties, doctors, appointments, and permissions.
- **Doctor**: Views and manages their appointment schedule.
- **Patient (User)**: Browses specialties, selects doctors, and books or manages appointments.

---

## 🚀 Features

### 🔐 Authentication & Authorization

- Multi-guard authentication using **Laravel Sanctum** for:
  - `admin_web`
  - `doctor_web`
  - `web` (user/patient)
- Role and permission management using **Spatie Laravel Permission**.
- Permissions are seeded and managed via Enums for clarity and type-safety.

---

### 👥 User Roles & Permissions

| Role   | Permissions                             |
|--------|-----------------------------------------|
| Admin  | `manage_specialties`, `manage_doctors`, `manage_patients`, `manage_appointments` |
| Doctor | `view_appointment`, `manage_own_appointments` |
| User   | `book_appointment`, `cancel_own_appointments`, `delete_pending_appointments`     |

> ✅ Permissions are defined using `PermissionEnum` and `UserRole` Enums for easy management and seeding.

---

## 📊 Dashboards

### 🛡️ Admin Dashboard
- View system stats (doctors, appointments, specialties).
- Manage:
  - Specialties (CRUD with multilingual names).
  - Doctors (CRUD + status toggling).
  - Patients list.
  - Soft-deleted appointments.

### 🩺 Doctor Dashboard
- View today's appointments.
- Confirm or reject (cancel) appointments.
- View full appointment history.

### 👤 Patient (User) Dashboard
- View today’s appointments and stats (confirmed/pending/canceled).
- Access specialty directory.
- Browse doctors by specialty.
- Book new appointments.
- Cancel or delete (if pending) own appointments.

---

## 📅 Appointment Management

- Unified working hours for all doctors (configurable via `config/appointments.php`).
- Time slot validation when booking.
- Enum-based appointment statuses:
  - `Pending`
  - `Confirmed`
  - `Canceled`
- Logic handled in `AppointmentService`:
  - Validates slot availability.
  - Cancels or deletes appointments securely.
- Patients can:
  - Cancel confirmed appointments.
  - Delete pending ones.

---

## 🌐 Multilingual Support

- All specialties and UI messages support **Arabic and English**.
- Powered by **Spatie Laravel Translatable**.
- Translation stored as **JSON columns** in the DB.

---

## 🧠 Architecture

- **Service Layer** (e.g., `AppointmentService`, `DoctorService`) for clean business logic.
- **Custom Eloquent scopes**:
  - `byUser()`
  - `byDoctor()`
  - `pending()`, `confirmed()`, `canceled()`
- **Controller-Service separation**: Controllers remain slim and focused.
- Event-driven design using Laravel **Events & Listeners**.
- **Soft Deletes** used for appointments.

---

## 📣 Notifications & Events

- On booking, `AppointmentBooked` event is fired.
- Listener sends **email notification** to both:
  - Doctor
  - Patient
- Email content is multilingual.

---

## 🗂️ Database Overview

| Table                  | Description                           |
|------------------------|---------------------------------------|
| `users`                | Patients                              |
| `doctors`              | Doctors                               |
| `admins`               | Admins                                |
| `specialties`          | Medical specialties (translatable)    |
| `doctor_specialty`     | Pivot linking doctors & specialties   |
| `appointments`         | Appointment records                   |
| `roles`, `permissions` | Handled via Spatie                    |
| `model_has_roles`      | Role assignments                      |
| `model_has_permissions`| Permission assignments                |

---

## 🧩 UX Enhancements

- Sidebar links for:
  - Dashboard
  - View Specialties
  - Browse Doctors by Specialty
  - My Appointments
- Dynamic action buttons:
  - Delete button shows **only** for pending appointments.
  - Cancel button shows **only** for confirmed appointments.
- Interactive confirmation dialogs (JS confirm).

---

## ⚙️ Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/boushra-mh/MedicalCenterManagementSystem.git
   cd MedicalCenterManagementSystem
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set DB credentials in `.env`**, then run:
   ```bash
   php artisan migrate --seed
   ```

5. **Serve the app**
   ```bash
   php artisan serve
   ```

---

## 🧪 Testing

- Run unit tests:
  ```bash
  php artisan test
  ```

---

## 📌 Future Improvements

- Live notifications for appointment status.
- Timezone-based working hours per doctor.
- Calendar-based booking view.
- Admin appointment analytics & charts.