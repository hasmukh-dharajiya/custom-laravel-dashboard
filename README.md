## About Laravel

Complete REST API with Laravel 8.x and Frontend integration Mini Project. The latest version of one of the most popular PHP frameworks - to create a REST API CRUD web application with a MySQL database and Front end styles from scratch and step by step starting with the installation of Composer (PHP package manager) to implementing and serving your application.

## How to use
1. git clone `git clone https://github.com/hasmukh-dharajiya/custom-laravel-dashboard.git`
2. Copy `.env.example file to .env`
3. Edit database credentials in .env file `DB_DATABASE=dashboard`
4. Run `composer install`
5. Run `php artisan key:generate`
6. Open `.env` file ang following code
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=      #Your Email ID #
MAIL_PASSWORD=      #Your Email Password #
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=  #Your Email ID #
MAIL_FROM_NAME="${APP_NAME}"
```
7. Run `php artisan ser`
8. `http://127.0.0.1:8000/`

`Note`: Please make sure Turn ON `Less secure app access` in your Google account without Email Not Send !.

You should see the list of Data, something like this:

![larave dashboard img](public/images/dashboard-image/dashboard.png)

## Feature
Key Feature of Project.

- Responsive Template use in dashboard
- use email Google and Laravel feature
- Custom Authentication System (without jetstream)
- Email Send for Conformation Email
- verify email, reset password email (custom codding)
- Laravel Blade Template
- Register,Login and forgot password without jetstream (custom codding)

`Note`: Please make sure Turn ON `Less secure app access` in your Google account without Email Not Send !. 
- Please Following:- `Manage your Google Account => Security => Less secure app access =>Trun ON` 

## Register View
![larave dashboard img](public/images/dashboard-image/register.gif)

## Forgot Password View
![larave forgot_password img](public/images/dashboard-image/forgot-password.gif)

## dashboard View
![larave dashboard img](public/images/dashboard-image/dashboard.png)
