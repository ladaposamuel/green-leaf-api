<?php

namespace Mpociot\ApiDoc\Tools;

use Illuminate\Support\Str;
use Illuminate\Routing\Route;
use Dingo\Api\Routing\RouteCollection;
use Illuminate\Support\Facades\Route as RouteFacade;

class RouteMatcher
{
    public function getDingoRoutesToBeDocumented(array $routeRules)
    {
        return $this->getRoutesToBeDocumented($routeRules, true);
    }

    public function getLaravelRoutesToBeDocumented(array $routeRules)
    {
        return $this->getRoutesToBeDocumented($routeRules);
    }

    public function getRoutesToBeDocumented(array $routeRules, bool $usingDingoRouter = false)
    {
        $matchedRoutes = [];

        foreach ($routeRules as $routeRule) {
            $includes = $routeRule['include'] ?? [];
            $allRoutes = $this->getAllRoutes($usingDingoRouter, $routeRule['match']['versions'] ?? []);

            foreach ($allRoutes as $route) {
                if (is_array($route)) {
                    $route = new LumenRouteAdapter($route);
                }

                if ($this->shouldExcludeRoute($route, $routeRule)) {
                    continue;
                }

                if ($this->shouldIncludeRoute($route, $routeRule, $includes, $usingDingoRouter)) {
                    $matchedRoutes[] = [
                        'route' => $route,
                        'apply' => $routeRule['apply'] ?? [],
                    ];
                    continue;
                }
            }
        }

        return $matchedRoutes;
    }

    // TODO we should cache the results of this, for Laravel routes at least,
    // to improve performance, since this method gets called
    // for each ruleset in the config file. Not a high priority, though.
    private function getAllRoutes(bool $usingDingoRouter, array $versions = [])
    {
        if (! $usingDingoRouter) {
            return RouteFacade::getRoutes();
        }

        $allRouteCollections = app(\Dingo\Api\Routing\Router::class)->getRoutes();

        return collect($allRouteCollections)
            ->flatMap(function (RouteCollection $collection) {
                return $collection->getRoutes();
            })->toArray();
    }

    private function shouldIncludeRoute(Route $route, array $routeRule, array $mustIncludes, bool $usingDingoRouter)
    {
        $matchesVersion = $usingDingoRouter
            ? ! empty(array_intersect($route->versions(), $routeRule['match']['versions'] ?? []))
            : true;

        return Str::is($mustIncludes, $route->getName())
            || Str::is($mustIncludes, $route->uri())
            || (Str::is($routeRule['match']['domains'] ?? [], $route->getDomain())
            && Str::is($routeRule['match']['prefixes'] ?? [], $route->uri())
            && $matchesVersion);
    }

    private function shouldExcludeRoute(Route $route, array $routeRule)
    {
        $excludes = $routeRule['exclude'] ?? [];

        // Exclude Laravel Telescope routes
        if (class_exists("Laravel\Telescope\Telescope")) {
            $excludes[] = 'telescope/*';
        }

        return Str::is($excludes, $route->getName())
            || Str::is($excludes, $route->uri());
    }
}
