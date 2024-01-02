<p align="center">
<a href="https://gitlab.com/jnkconsultbv/the-perfect-code-dev/-/commits/main"><img alt="pipeline status" src="https://gitlab.com/jnkconsultbv/the-perfect-code-dev/badges/main/pipeline.svg" /></a>
<a href="https://gitlab.com/jnkconsultbv/the-perfect-code-dev/-/commits/main"><img alt="coverage report" src="https://gitlab.com/jnkconsultbv/the-perfect-code-dev/badges/main/coverage.svg" /></a>
<a href="https://gitlab.com/jnkconsultbv/the-perfect-code-dev/-/releases"><img alt="Latest Release" src="https://gitlab.com/jnkconsultbv/the-perfect-code-dev/-/badges/release.svg" /></a>
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

