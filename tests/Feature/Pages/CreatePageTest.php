<?php

declare(strict_types=1);

namespace Tests\Feature\Pages;

use App\Models\Page;
use App\Models\Team;
use App\Models\User;
use Tests\TestCase;

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

test('create page screen can be rendered', function (): void {
    $response = asUser()->get('/code/new');

    expect($response->status())->toBe(200);
});

test('create page', function (): void {
    $response = asUser()->post('/code/store', [
        'title' => 'test',
        'description' => 'test',
        'resume' => 'test',
        'code' => 'test',
        'tags' => ['test'],
    ]);

    $response->assertRedirect('/code/my');

    expect(Page::all()->count())->toBe(1)->and(Page::first()->title)->toBe('test');
});
