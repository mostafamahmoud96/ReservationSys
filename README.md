# Reservation System

Reservation System in PHP/Laravel Framework.

## Installation

Use Git and Composer to install Reservation System.

```bash
git clone https://github.com/mostafamahmoud96/ReservationSys.git
cd ReservationSystem
cp .env.example .env
composer install
php artisan migrate --seed
php artisan serve
```

## Usage
use Postman Collection to test APIs.

##### APIS:
1. List Menu with Available meals per day
2.  check if certain table available by certain date and time.
3. Reserve a table if capacity allowed and table is available or place your reservation in waiting list
4. create an order to your reservation
5. view and print your order invoice
