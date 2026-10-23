<?php

declare(strict_types=1);

namespace IllumaLaw\WayfinderForge\Routing;

use Illuminate\Support\Str;

final class RoutePrefixCollector
{
    /**
     * @param  iterable<string>  $uris
     * @return array<int, string>
     */
    public static function fromUris(iterable $uris): array
    {
        /** @var array<string, string> $prefixes */
        $prefixes = [];
        foreach ($uris as $uri) {
            $prefix = explode('/', $uri, 2)[0];
            if ($prefix === '' || Str::contains($prefix, '{')) {
                continue;
            }

            $prefixes[$prefix] = $prefix;
        }

        $prefixes = array_values($prefixes);
        sort($prefixes);

        return $prefixes;
    }
}
