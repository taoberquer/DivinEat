<?php

namespace App\Core\Routing;

use App\Core\Collection;

class Router
{
    private static Collection $routes;

    protected array $params = ['prefix' => '', 'as' => '', 'namespace' => '', 'middleware' => []];

    public function __construct(array $params = [])
    {
        $this->params = $this->mergeParams($params);
    }

    public function group(array $params, callable $function)
    {
        return $function (new Router($this->mergeParams($params)));
    }

    public function get(string $routePath, string $controllerName, ?string $routeName = null): Route
    {
        return $this->addRoute('GET', $routePath, $controllerName, $routeName);
    }

    public function post(string $routePath, string $controllerName, ?string $routeName = null): Route
    {
        return $this->addRoute('POST', $routePath, $controllerName, $routeName);
    }

    public function put(string $routePath, string $controllerName, ?string $routeName = null): Route
    {
        return $this->addRoute('POST', $routePath, $controllerName, $routeName);
    }

    public function delete(string $routePath, string $controllerName, ?string $routeName = null): Route
    {
        return $this->addRoute('POST', $routePath, $controllerName, $routeName);
    }

    protected function mergeParams(array $params): array
    {
        $params = array_merge($this->params, $params);
        $params['namespace'] = preg_replace('/[\\\]{2,}/', '\\', $params['namespace'] . '\\');
        $params['prefix'] = preg_replace('/[\/]{2,}/', '/', '/' . $params['prefix'] . '/');

        return $params;
    }

    protected function addRoute(string $routeType, string $routePath, string $controllerName, ?string $routeName): Route
    {
        $route = new Route(
            $routeType,
            $this->params['prefix'] . $routePath,
            $this->params['namespace'] . $controllerName,
            $routeName !== null ? $this->params['as'] . $routeName : '',
            $this->params['middleware']
        );

        self::getRoutes()->append($route);

        return $route;
    }

    public static function getRoutes(): Collection
    {
        if (!isset(self::$routes))
            self::$routes = new Collection();

        return self::$routes;
    }

    public static function getRouteList(): array
    {
        $routeList = [];

        foreach (self::getRoutes()->getIterator() as $route) {
            array_push($routeList, [
                'Name' => $route->getName(),
                'Type' => $route->getType(),
                'Url' => $route->getUrl(),
                'Controller' => $route->getController(),
                'Method' => $route->getMethod(),
                'Middleware' => $route->getMiddleware(),
            ]);
        }

        return $routeList;
    }

    public static function getRouteByName(string $routeName): ?Route
    {
        foreach (self::getRoutes()->getIterator() as $route)
            if ($route->name === $routeName)
                return $route;

        return null;
    }

    public static function getRouteByUrl(string $requestUri): ?Route
    {
        foreach (self::getRoutes()->getIterator() as $route)
            if (preg_match('/^' . $route->regexPath . '$/', $requestUri))
                return $route;

        return null;
    }

    public static function getRouteByUrlAndType(string $requestUri, string $type): ?Route
    {
        foreach (self::getRoutes()->getIterator() as $route)
            if (preg_match('/^' . $route->regexPath . '$/', $requestUri) && $route->getType() === $type)
                return $route;

        return null;
    }

    public static function redirect(string $routeName, array $args = []): void
    {
        //TODO : Ajouter les redirections pour les routes avec arguments
        $route = self::getRouteByName($routeName);
        if ($route === null)
            throw new \Exception('La redirection est impossible, la route n\'existe pas');

        header('Location: ' . $route->getUrl());
    }
}