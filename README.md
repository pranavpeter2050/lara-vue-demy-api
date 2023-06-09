<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

## List of commands

| Command | Usage |
|-------------------------------------- | ---------------------------|
| php artisan make:model |                           |
| php artisan route:list --path=api |                           |
| php artisan make:resource TaskResource | To create an API resource                 |
| php artisan make:controller |                           |

## Eloquent API Resource

It is a mechanism to transform your Eloquent model into JSON responses. When we use this to return response to the frontend, we will see our (Tasks) collection wrapped inside a "data" array.

## Securing APIs using Laravel Sanctum

Latest versions of Laravel should have Sanctum pre-installed. Check if you have it or not. Now, publish the Sanctum configuration and migration files using the vendor:publish Artisan command. The sanctum configuration file will be placed in your application's config directory:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

Next, if you plan to utilize Sanctum to authenticate a SPA, you should add Sanctum's middleware to your api middleware group within your application's app/Http/Kernel.php file:

```bash
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

Add `SESSION_DOMAIN=localhost` in `.env` if it's not there.

### SPA Authentication - Signing users in

Run below command to create an **invokable** LoginController:

```bash
php artisan make:controller Auth/LoginController -i
```

Create a Form-request validator for the newly created controller by running:

```bash
php artisan make:request LoginRequest
```

Open Laravel Tinker and generate a new user.

```bash
// to open tinker
php artisan tinker

// to create new user using tinker 
App\Models\User::factory()->create()
```

### SPA Authentication - Signing users in

Create a invokable LogoutController: 

```bash
php artisan make:controller Auth/LogoutController -i
```


## Notes

- Since we are building API, we don't need the `create()`, `edit()` methods in `TaskController`.
- Since we need the same rules from `StoreTaskRequest`, we empty the `UpdateTaskRequest` and then extend the `UpdateTaskRequest` with  `StoreTaskRequest`.
- `CompleteTaskController` was made `invokable` by running `php artisan make:controller` -> specifying the name -> selecting "invokable".

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## References

- [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum)
