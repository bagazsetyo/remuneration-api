# Payroll Engine - Employee Work Tracking & Remuneration System

## Project Overview

Aplikasi untuk mencatat pekerjaan pegawai dan menghitung remunerasi secara otomatis. Sistem ini mendukung pekerjaan individual maupun kolaboratif dengan pembagian biaya yang proporsional berdasarkan kontribusi jam kerja.

---

## Technology Stack

### Backend
- **Laravel 12** - PHP Framework
- **MySQL 8.0** - Database

### Frontend
- **Next.js 15** - React Framework
- **TypeScript** - Type Safety
- **Tailwind CSS** - Styling
- **Shadcn/UI** - UI Components

### Development Tools
- **Postman** - API Testing
- **dbdiagram.io** - Database Design

---

## Remuneration Calculation Formula

Perhitungan berdasarkan jumlah kontribusi jam dalam suatu project. Dengan menggunakan metode ini diharapkan pembagiannya akan lebih adil dan tidak perlu membuat dua fungsi yang berbeda sehingga mempercepat dalam development.

**Data Proyek:**
- Tugas: Pengembangan Website
- Biaya Tambahan: Rp 300,000

**Data Pegawai:**
- Pegawai A: 10 jam × Rp 75,000/jam = Rp 750,000
- Pegawai B: 6 jam × Rp 60,000/jam = Rp 360,000
- Pegawai C: 4 jam × Rp 50,000/jam = Rp 200,000
- **Total jam kerja: 20 jam**

**Perhitungan:**

1. **Proporsi Kontribusi:**
    - Pegawai A: 10/20 = 50%
    - Pegawai B: 6/20 = 30%
    - Pegawai C: 4/20 = 20%

2. **Distribusi Biaya Tambahan:**
    - Pegawai A: Rp 300,000 × 50% = Rp 150,000
    - Pegawai B: Rp 300,000 × 30% = Rp 90,000
    - Pegawai C: Rp 300,000 × 20% = Rp 60,000

3. **Total Remunerasi:**
    - Pegawai A: Rp 750,000 + Rp 150,000 = **Rp 900,000**
    - Pegawai B: Rp 360,000 + Rp 90,000 = **Rp 450,000**
    - Pegawai C: Rp 200,000 + Rp 60,000 = **Rp 260,000**

**Total Proyek: Rp 1,610,000**

---

## System Architecture

### API Architecture
- RESTful API
- Service Pattern untuk business logic
- Resource Classes untuk API response formatting
- Request Classes untuk input validation

---

## Database Design (ERD)
![image](https://github.com/bagazsetyo/remuneration/blob/master/public/erd.PNG)

---

## User Interface Flow

### Main Workflow

1. Dashboard Overview
2. Manage Employees
    - Add New Employee
    - Edit Employee Details
    - View Employee Summary
3. Create New Project
    - Enter Project Details
    - Set Additional Charges
    - Save Project
4. Assign Employees to Project
    - Select Employees
    - Set Join Date & Hourly Rate
    - Add to Project
5. Complete Project
    - Mark as Completed
    - Lock Data from Changes
    - Generate Final Report

---

## Setup Instructions

### Backend (Laravel)
```bash
# Clone repository
git clone https://github.com/bagazsetyo/remuneration-api.git
cd remuniration-api

# Install dependencies
composer install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Start development server
php artisan serve
```

---

## API Documentation

### Base URL
```
Development: http://localhost:8000/api
Production: https://your-domain.com/api
```

### Key Endpoints
```
GET    /employee
GET    /employee/all              
POST   /employee       
GET    /employee/{id}  
PUT    /employee/{id}  
DELETE /employee/{id}  

POST   /contribution     
GET    /contribution/{id}
PUT    /contribution/{id}
DELETE /contribution/{id}

GET    /project         
POST   /project       
GET    /project/{id}  
PUT    /project/{id}  
DELETE /project/{id}  
```

## Challenge

**Tantangan yang dihadapi**

Memperkirakan biaya remunerasi agar di bagi secara merata

**Solusi**

Membagi berdasarkan jam kerja masing masing pegawai, sehingga pembagiannya akan lebih merata dan adil
