# Spectrum App

Spectrum is a Laravel-based web application designed to manage neurodiverse learners' educational and therapeutic progress. It connects **learners**, **teachers**, **therapists**, and **parents** in one integrated system, making daily therapy tracking and communication seamless.

## Key Features

- **Learner Management**
  - Create and manage learner profiles with relevant personal, educational, and therapeutic information.

- **Teacher and Therapist Management**
  - Assign teachers and therapists to learners.
  - Manage staff information and specializations.

- **Daily Therapy Reports**
  - Therapists can upload detailed daily therapy reports per learner.
  - Reports can include session notes, progress updates, and recommendations.

- **Parent Portal**
  - Parents can view daily therapy reports for their child(ren).
  - Parents can download therapy reports for offline access.

- **Secure Access and Roles**
  - Role-based authentication for Admins, Teachers, Therapists, and Parents.
  - Each user type sees a personalized dashboard and access specific to their role.

## Tech Stack

- **Backend:** Laravel (PHP Framework)
- **Frontend:** Blade Templates / Vue.js (optional)
- **Database:** MySQL
- **Authentication:** Laravel Breeze / Sanctum / Jetstream

## Setup Instructions

1. **Clone the Repository**

    ```bash
    git clone https://github.com/your-username/spectrum-app.git
    cd spectrum-app
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install
    npm run build
    ```

3. **Environment Configuration**

    - Copy the example `.env` file:

      ```bash
      cp .env.example .env
      ```

    - Set your database, mail, and app configurations in `.env`.

4. **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

5. **Run Migrations and Seeders**

    ```bash
    php artisan migrate --seed
    ```

    *(Seeders will create default roles: Admin, Teacher, Therapist, Parent.)*

6. **Serve the Application**

    ```bash
    php artisan serve
    ```

7. **Access the App**
    - Navigate to `http://localhost:8000`

## User Roles

| Role      | Permissions                                          |
| --------- | ---------------------------------------------------- |
| Admin     | Manage users, learners, reports, and settings        |
| Teacher   | View learners, collaborate on educational planning   |
| Therapist | Submit and manage daily therapy reports              |
| Parent    | View and download therapy reports for their learners |

## Daily Therapy Report Workflow

1. **Therapist logs in** and selects a learner.
2. **Uploads a new therapy report** for the day (notes, session details, outcomes).
3. **Parent logs in** and **views** the daily report on their dashboard.
4. **Parent can download** reports as needed for records.

## Contribution

Interested in improving Spectrum? Contributions are welcome!

- Fork the repository
- Create your feature branch (`git checkout -b feature/feature-name`)
- Commit your changes (`git commit -m 'Add new feature'`)
- Push to the branch (`git push origin feature/feature-name`)
- Open a pull request

## License

This project is open-sourced under the [MIT license](LICENSE).
