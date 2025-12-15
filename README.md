# MyCourt - Sports Venue Booking System

**MyCourt** is a web-based information system designed to facilitate the booking of sports venues (Futsal, Badminton, Basketball) online in real-time. [cite_start]This project aims to solve the problems of manual booking, such as lack of schedule transparency and double-booking risks[cite: 13, 14, 122].

[cite_start]Built with **Laravel**, MyCourt streamlines the process for Users to book fields and allows Managers/Admins to manage schedules and transactions efficiently[cite: 19, 126].

## 🚀 Key Features

### 👤 User (Penyewa)
* **Real-time Schedule:** View available time slots visually (Green = Available, Red = Booked).
* **Booking System:** Easy booking process with **Double Booking Prevention** logic.
* **Dashboard:** View booking history and booking status.
* **Sport Categories:** Filter fields by Futsal, Badminton, or Basketball.

### 🏢 Manager (Pengelola Lapangan)
* [cite_start]**Booking Verification:** Approve or Reject incoming booking requests[cite: 192].
* [cite_start]**Schedule Management:** Manually block/close specific time slots for maintenance[cite: 189].
* **Dashboard Panel:** View daily income and pending booking statistics.

### 🛡️ Admin
* [cite_start]**User Management:** Manage registered users (view, delete)[cite: 194].
* **System Overview:** View total users, total managers, and field statistics.

---

## 🛠️ Tech Stack

* [cite_start]**Framework:** Laravel 10/11 (PHP) [cite: 46, 130]
* [cite_start]**Database:** MySQL [cite: 44, 131]
* **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
* [cite_start]**Tools:** Visual Studio Code, GitHub [cite: 43]

---

## 👥 Authors (Kelompok 6)

* [cite_start]**Ivan Mahadika Yanuarizqi** (103032300055) [cite: 5, 106]
* [cite_start]**Farhan Haiko Rizqi** (103032300060) [cite: 5, 106]
* [cite_start]**Wirdatul Ahya** (103032300071) [cite: 5, 106]
* [cite_start]**Lu'luil Maknun** (103032300092) [cite: 5, 106]
* [cite_start]**Made Naradeon Handika P.** (103032300101) [cite: 5, 106]

---

## 💻 Run Locally

Follow these steps to set up and run the project on your local machine.

### Prerequisites
* PHP >= 8.1
* Composer
* Node.js & NPM
* MySQL

### Installation Steps

1.  **Clone the Repository**
    ```bash
    git clone [https://github.com/your-username/mycourt.git](https://github.com/your-username/mycourt.git)
    cd mycourt
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Install JavaScript Dependencies**
    ```bash
    npm install
    ```

4.  **Environment Setup**
    Copy the example environment file and configure your database credentials.
    ```bash
    cp .env.example .env
    ```
    Open `.env` file and set your database connection:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=mycourt_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Generate App Key**
    ```bash
    php artisan key:generate
    ```

6.  **Migrate and Seed Database**
    This command will create the tables and inject **Test Accounts** (Admin, Manager, User) and **Dummy Fields**.
    ```bash
    php artisan migrate:fresh --seed
    ```

7.  **Run the Application**
    You need to run two terminals simultaneously:

    **Terminal 1 (Vite/Tailwind):**
    ```bash
    npm run dev
    ```

    **Terminal 2 (Laravel Server):**
    ```bash
    php artisan serve
    ```

8.  **Access the App**
    Open your browser and visit: `http://127.0.0.1:8000`

---

## 🔐 Testing Credentials

Use these accounts to test the different roles and features:

| Role | Email | Password | Access |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@mycourt.com` | `password` | User Management, System Stats |
| **Manager** | `manager@mycourt.com` | `password` | Approve Bookings, Manage Schedule |
| **User** | `user@mycourt.com` | `password` | Booking Fields, View Schedule |