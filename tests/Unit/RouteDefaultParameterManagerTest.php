<?php

declare(strict_types=1);

use IllumaLaw\WayfinderForge\Routing\RouteDefaultParameterManager;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\URL;

it('forgets selected default URL parameters', function () {
    URL::defaults([
        'team' => 'alpha',
        'current_team' => 'alpha',
        'locale' => 'en',
    ]);

    $urlGenerator = URL::getFacadeRoot();
    if (! ($urlGenerator instanceof UrlGenerator)) {
        throw new RuntimeException('The URL facade must resolve a URL generator.');
    }

    RouteDefaultParameterManager::forget($urlGenerator, ['team', 'current_team']);

    expect($urlGenerator->getDefaultParameters())
        ->toHaveKey('locale', 'en')
        ->not->toHaveKey('team')
        ->not->toHaveKey('current_team');
});

it('registers the configured URL macro for clearing defaults', function () {
    URL::defaults([
        'team' => 'beta',
        'current_team' => 'beta',
        'locale' => 'pt',
    ]);

    /** @phpstan-ignore staticMethod.notFound */
    URL::forgetTeamRouteDefaultParameters();

    $urlGenerator = URL::getFacadeRoot();
    if (! ($urlGenerator instanceof UrlGenerator)) {
        throw new RuntimeException('The URL facade must resolve a URL generator.');
    }

    expect($urlGenerator->getDefaultParameters())
        ->toHaveKey('locale', 'pt')
        ->not->toHaveKey('team')
        ->not->toHaveKey('current_team');
});
