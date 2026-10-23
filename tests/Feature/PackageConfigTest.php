<?php

it('loads the package config defaults', function () {
    expect(config('wayfinder-forge.client'))->toBe('axios')
        ->and(config('wayfinder-forge.output_path'))->toBe(resource_path('js/api/sdk.ts'))
        ->and(config('wayfinder-forge.route_defaults.forget_macro_name'))
        ->toBe('forgetTeamRouteDefaultParameters');
});
