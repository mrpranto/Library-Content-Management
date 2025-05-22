
## Project Setup Instructions
- 1. Clone code from github repository
> https://github.com/mrpranto/Library-Content-Management
- 2. Rename .env.example to .env
- 3. Install composer
> `composer install`
- 4. Generate key to .env file
> `php artisan key:generate`
- 5. Set database credentials to .env database section
- 6. Migrate database table
> `php artisan migrate`
- 7. After complete all this now you can run your laravel application
> `php artisan serve`
