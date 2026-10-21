<?php
// TODO  1.  Передавать query-параметры
// * 2  Добавить PUT
// * 3  Исправить обработку неизвестного HTTP-метода
//  * 4 Добавить 405 Method Not Allowed
// * 5 Нормализовать path
//  ? 6 Экранировать статическую часть маршрута (сделать если появятса маршруты по типу  /api/search+(advanced) /api/v1.0/events) а пока можно забить 
// * 7 Сделать параметры маршрута отдельными 

class Router
{
    private array $routes = [];

  

    public function get(
        string $path,
        callable $handler,
        array $middleware = []
    ): void
    {
        $this->addRoute('GET', $path, $handler, $middleware);
    }

    public function post(
        string $path,
        callable $handler,
        array $middleware = []
    ): void
    {
        $this->addRoute('POST', $path, $handler, $middleware);
    }

    public function put(
        string $path,
        callable $handler,
        array $middleware = []
    ): void
    {
        $this->addRoute('PUT', $path, $handler, $middleware);
    }

    public function patch(
        string $path,
        callable $handler,
        array $middleware = []
    ): void
    {
        $this->addRoute('PATCH', $path, $handler, $middleware);
    }

    public function delete(
        string $path,
        callable $handler,
        array $middleware = []
    ): void
    {
        $this->addRoute('DELETE', $path, $handler, $middleware);
    }

// * рекомендуемы вариант
//     $params = [
//     'route' => [
//         'eventId' => '15'
//     ],
//     'query' => [
//         'status' => 'upcoming',
//         'page' => '2',
//         'limit' => '10'
//     ],
//     'auth' => [
//         'user_id' => 1
//     ]
// ];

    private function addRoute(
        string $method,
        string $path,
        callable $handler,
        array $middleware = []
    ): void {
        $this->routes[$method][$path] = [
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    public function run(): void


{
    // Получаем HTTP-метод
    $method = $_SERVER['REQUEST_METHOD'];

    // Получаем путь и query-параметры из URL
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($requestUri, PHP_URL_PATH) ?: '/';
    $queryString = parse_url($requestUri, PHP_URL_QUERY) ?? '';
    $queryParams = [];
    parse_str($queryString, $queryParams);

    $path = rtrim($path, '/');

    if ($path === '') {
        $path = '/';
    }

    // Ищем обработчик для этого метода и пути
    // $handler = $this->routes[$method][$path] ?? null;

    $routeFind = false;
    $currentHandler = null ;
    $currentMiddleware = [];

    $params = [
        'route' => [],
        'query' => $queryParams,
        'auth' => []
    ];
    

    $methodRoutes = $this->routes[$method] ?? [];


    // поиск подходящего под динамические параметры маршрута
    foreach($methodRoutes as $route => $routeDefinition){ 
        $routePattern = preg_replace(
            '#\{[^}]+\}#',
            '([^/]+)',
            $route
        );
        $regex = '#^' . $routePattern . '$#';

        if(preg_match($regex, $path, $matches)){
            $routeFind = true;
            $currentHandler = $routeDefinition['handler'];
            $currentMiddleware = $routeDefinition['middleware'];
            

            preg_match_all(
                '#\{[^}]+\}#',
                $route,
                $paramMatches
            );

            $paramSeq = $paramMatches[0]; // массив  упорядоченых параметров

            foreach ($paramSeq as $index => $paramName) {
                $paramName = substr($paramName, 1,-1);
                $params['route'][$paramName] = urldecode($matches[$index + 1]);
            }
            break;
                    
        }

    }
    

    // Говорим клиенту, что ответ будет JSON
    header('Content-Type: application/json');

    if (!$routeFind) {
        http_response_code(404);

        echo json_encode([
            'error' => 'Route not found'
        ]);

        return;
    }

    

    if(!empty($currentMiddleware)){
        foreach($currentMiddleware as $mid){
            if (!is_object($mid) || !method_exists($mid, 'handle')) {
                throw new LogicException(
                    'Route middleware must be an object with a handle() method'
                );
            }

            $middlewareResult = $mid->handle();
            if (
                !is_array($middlewareResult)
                || !array_key_exists('ok', $middlewareResult)
                || !is_bool($middlewareResult['ok'])
            ) {
                throw new UnexpectedValueException(
                    'Middleware handle() must return an array with a boolean "ok" value'
                );
            }

            if (!$middlewareResult['ok']) {
                $status = $middlewareResult['status'] ?? null;
                $error = $middlewareResult['error'] ?? null;

                if (
                    !is_int($status)
                    || $status < 400
                    || $status > 599
                    || !is_string($error)
                ) {
                    throw new UnexpectedValueException(
                        'Rejected middleware result must include a valid status and error'
                    );
                }

                http_response_code($status);
                echo json_encode(['error' => $error]);
                return;
            }

            if (array_key_exists('user_id', $middlewareResult)) {
                $params['auth']['user_id'] = $middlewareResult['user_id'];
            }

            if (array_key_exists('user', $middlewareResult)) {
                $params['auth']['user'] = $middlewareResult['user'];
            }
        }
    }

    
    if($currentHandler === null){
        http_response_code(405);
        echo json_encode([
            'error' => 'Method Not Allowed'
        ]);
        return;
    }
    $result = $currentHandler($params);

    // Возвращаем его результат как JSON
    echo json_encode($result);
}
}