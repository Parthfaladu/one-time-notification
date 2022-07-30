# Post one time notification

The project focuses on creating a notification for user and user can see notification in their dashboard and mark as read perticular notification.

## Technical details

- Laravel 8
- Bootstrap 4
- Jquery
- Vue

## Installation and setup

Unzip file and to install laravel and javascript dependency run following command
```sh
cd one-time-notification
composer install
npm install
```
create `.env` file coping `.env.example` file
```sh
cp .env.example .env
```
Set Database connection fields in `.env` file
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={db_name}
DB_USERNAME={db_username}
DB_PASSWORD={db_password}
```
To run migration and seed user data run following commands:
```sh
php artisan migrate
php artisan db:seed
```
To compile assets, css and js file in mix run following command:
```sh
php artisan dev or php artisan watch
```
To run the project use the following command:
```sh
php artisan serve
```

## Application access details

- user list page will be display on the `/user` url.
- clicking on action column settings button, update user settings page will be display on `/user/{user}` url.
- clicking on perticular user name or user email, dashboard will be display on `/user/dashboard/{user_id}` url.
- in header right side clicking on notification icon that perticular user all notifications will be display.
- in that unread notification will be display as bold and clicking on perticular notification it will be marked as read.
- notification list page will be display on the `/notification` url.
- clicking on `Post notification` menu in header, post notification page will be display on `notification/create` url
- by submitting this notification form selected users can see new notification in their dashboard

 
