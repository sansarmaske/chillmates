
# Kosadecks

Personal, family, and roommates finance and chore tracker.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Introduction

Kosadecks is a web application designed to help individuals, families, and roommates manage their finances and chores effectively. Built with Blade and PHP, this application provides a user-friendly interface to track expenses, incomes, and chores.

## Features

- **Finance Tracking**: Record and categorize expenses and incomes.
- **Chore Management**: Assign and track household chores.
- **User Authentication**: Secure login and registration for users.
- **Responsive Design**: Accessible on various devices.

## Installation

To get started with Kosadecks, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/sansarmaske/kosadecks.git
   ```
2. **Navigate to the project directory:**
   ```bash
   cd kosadecks
   ```
3. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```
4. **Set up environment variables:**
   - Copy `.env.example` to `.env` and configure your environment variables.
   ```bash
   cp .env.example .env
   ```
5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```
6. **Run migrations:**
   ```bash
   php artisan migrate
   ```
7. **Serve the application:**
   ```bash
   php artisan serve
   ```

## Usage

Once the application is up and running, you can start using Kosadecks to manage your finances and chores. Register an account, log in, and explore the features available.

## Contributing

We welcome contributions! If you're interested in contributing to Kosadecks, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes and commit them (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Open a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

If you have any questions, feel free to reach out:

- **GitHub Issues:** [https://github.com/sansarmaske/kosadecks/issues](https://github.com/sansarmaske/kosadecks/issues)


