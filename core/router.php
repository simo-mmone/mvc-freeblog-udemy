<?php

namespace App\Core;

use Exception;

class Router {

    public function __construct(
        protected array $routes = [
            'GET' => [],
            'POST' => [],
        ]
    ) {
    }

    public function dispatch(): array {
        $url = $_SERVER['REQUEST_URI'] ?? $_SERVER['REDIRECT_URL'];
        $segment = trim(parse_url($url, PHP_URL_PATH), '/');
        $segment = $segment ?: '/';
        $method = $_SERVER['REQUEST_METHOD'];
        $urls = $this->routes[$method];

        //match esatto
        if (array_key_exists($segment, $urls)) {
            return $urls[$segment];
        }

        //match con regex
        $ret = $this->matchRoute($urls, $segment);
        if (!$ret) {
            throw new Exception('Route not found');
        }
        return $ret;
    }

    protected function matchRoute(array $urls, string $segment): array{
        $ret = [];
        foreach ($urls as $seg => $classArray) {
            // if(!str_contains($seg, ':')) {
            //     continue;
            // }
            // psts/:id[0-9]+  <-  posts/5
            // :(a-zA-Z0-9\-\_)
            $seg = preg_quote($seg);
            $pattern = preg_replace('/\\\:[a-zA-Z0-9\-\_]+/', '([a-zA-Z0-9\-\_]+)', $seg);
            $matches = [];
            // var_dump($pattern);
            if (preg_match("@^$pattern$@", $segment, $matches)) {
                array_shift($matches);
                $classArray[] = $matches;
                $ret = $classArray;
                break;
            }
            // var_dump($matches);
        }
        return $ret;
    }

    public function loadRoutes(array $routes): void
    {
        $this->routes = $routes;
    }

    public function getRoutes(): array {
        return $this->routes;
    }
}