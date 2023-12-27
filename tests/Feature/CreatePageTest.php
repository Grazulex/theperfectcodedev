<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;


test('create page screen can be rendered', function (): void {
    $user = User::factory()->create();
    $this->actingAs($user);

    expect($user->id)->toBe(1);
    $this->assertAuthenticated();
    dd($user);

    $response = $this->get('/code/new');

    $response->assertStatus(200);
});
