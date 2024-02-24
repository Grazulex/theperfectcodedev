<p align="center">
![Latest workflow](https://github.com/Grazulex/theperfectcodedev/actions/workflows/laravel.yml/badge.svg)
[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2Ff386a02e-accf-494d-9f33-cd931f462b6c%3Fdate%3D1%26commit%3D1&style=plastic)](https://forge.laravel.com/servers/546270/sites/2208781)

</p>

## About The Perfect Code Dev

## Todo
Find here the [Todo](docs/todo.md) list.


## Test data (login)

```
php artisan migrate:fresh --seed
```

```
$me = User::factory()->create([
'name' => 'Admin',
'email' => 'admin@test.com',
'password' => bcrypt('password'),
'current_team_id' => 1,
]);
```


## Queues

./artisan queue:work --queue=mail-queue,likes-queue,follows-queue --tries=3 --timeout=90

- mail-queue
- likes-queue
- follows-queue


