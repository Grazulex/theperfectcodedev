<?php

declare(strict_types=1);

namespace Tests\Feature\Pages;

test('top page screen can be rendered if login', function (): void {
    $response = asUser()->get(route('pages.top'));

    expect($response->status())->toBe(200);
});

test('top page screen can be rendered if logout', function (): void {
    $response = $this->get(route('pages.top'));

    expect($response->status())->toBe(200);
});
