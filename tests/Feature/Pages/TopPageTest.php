<?php

declare(strict_types=1);

namespace Tests\Feature\Pages;

test('top page screen can be rendered if login', function (): void {
    $response = asUser()->get('/code/top');

    expect($response->status())->toBe(200);
});

test('my page screen can  be rendered if not login', function (): void {
    $response = $this->get('/code/top');

    expect($response->status())->toBe(200);
});
