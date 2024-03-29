<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/


use App\Actions\Pages\CreatePageAction;
use App\Models\Page;
use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

uses(
    TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

//expect()->extend('toBeOne', fn() => $this->toBe(1));

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/
function makeUser(): User
{
    $user = User::factory()->create([
        'current_team_id' => 1,
    ]);
    Team::factory(1)->create([
        'user_id' => $user->id,
        'name' => 'Grazulex',
        'personal_team' => true]);

    return $user;
}

function makePage(int $is_accept_version = 0): Page
{
    $user = makeUser();
    return (new CreatePageAction())->handle(
        user: $user,
        attributes: [
            'title' => 'test',
            'description' => 'test',
            'resume' => 'test',
            'code' => 'test',
            'tags' => ['test'],
            'user_id' => $user->id,
            'is_accept_version' => $is_accept_version,
        ]
    );
}

function asUser(): TestCase
{
    $user = User::factory()->create([
        'current_team_id' => 1,
    ]);
    Team::factory(1)->create([
        'user_id' => $user->id,
        'name' => 'Grazulex',
        'personal_team' => true]);

    return test()->actingAs($user);
}
