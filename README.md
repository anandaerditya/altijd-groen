## About The Project

This project is used for testing purposes only.

## Tech Stacks
This project using the following technologies such as :

- [Laravel](https://laravel.com)
- [MySQL](https://www.mysql.com)

## Installation

Follow these steps to install the project to your computer.

1. **Clone this project**.
   -## Clone this project by run the command as follows:

       git clone https://github.com/anandaerditya/altijd-groen your_directory_name

2. **Copy .env files**
   -## Use the following command to copy `.env` configuration files. Then hit `Enter`

        cp .env.example .env

3. **Installing Composer Packages**
   -## Use the following command to install Laravel's required packages trough Composer. Then hit `Enter`

        composer install

4. **Generate Key**
   -## Use the following command to generate key to project directory. Then hit `Enter`

        php artisan key:generate

5. **Run Database Migration & Seeding**
   -## Make sure your database name are registered to your database administrator and it's the same name inside `.env` file. Use the following command,  Then hit `Enter`

        php artisan migrate --seed

6. **Serve the Project**
   -## You can quickly run this project with the following command :

        php artisan serve


## Credentials
This project provides two user accounts you can use with the respective password :

1. User 1 : `user_1 | user_1`
2. User 2 : `user_2 | user_2`
