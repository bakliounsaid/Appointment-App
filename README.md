# Appointment-App

Web application built with Laravel and Livewire for a curtain-fitting business, combining appointment booking, product sales, and an admin dashboard.

## Overview

This project was built as a freelance developer for a real client, covering the full lifecycle from requirements gathering to deployment and client support.

## Features

**Client side**
- Book an appointment for curtain fitting
- Browse and purchase curtain-related products (catalog + cart)
- Track the status of a request

**Admin side**
- Dashboard to monitor all appointments
- Transform appointment status (confirm, reschedule, close)
- Manage day-to-day business activity, no technical skills required

## Tech Stack

- **Backend:** Laravel
- **Frontend:** Livewire (reactive UI without page reloads)
- **Database:** MySQL

## Getting Started

1. Clone the repository
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and set your MySQL credentials
4. Generate the application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Start the local server: `php artisan serve`

## Author

Developed by Baklioun Essaid — [Portfolio](https://bakliounessaid.netlify.app) · [LinkedIn](https://linkedin.com/in/baklioun-essaid)
