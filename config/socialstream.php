<?php

declare(strict_types=1);

use App\Providers\RouteServiceProvider;
use JoelButcher\Socialstream\Features;
use JoelButcher\Socialstream\Providers;

return [
    'middleware' => ['web'],
    'prompt' => 'Or Login Via',
    'providers' => [
        Providers::github(),
        Providers::gitlab(),
        Providers::google(),
    ],
    'features' => [
        Features::createAccountOnFirstLogin(),
        Features::generateMissingEmails(),
        Features::rememberSession(),
        Features::providerAvatars(),
        Features::refreshOAuthTokens(),
    ],
    'redirects' => [
        'login' => RouteServiceProvider::HOME,
        'register' => RouteServiceProvider::HOME,
    ],
];
