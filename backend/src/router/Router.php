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
        array $middleware = [],
        array $constraints = []
    ): void
    {
        $this->addRoute('GET', $path, $handler, $middleware, $constraints);
    }

    public function post(
        string $path,
        callable $handler,
        array $middleware = [],
        array $constraints = []
    ): void
    {
        $this->addRoute('POST', $path, $handler, $middleware, $constraints);
    }

    public function put(
        string $path,
        callable $handler,
        array $middleware = [],
        array $constraints = []
    ): void
    {
        $this->addRoute('PUT', $path, $handler, $middleware, $constraints);
    }

    public function patch(
        string $path,
        callable $handler,
        array $middleware = [],
        array $constraints = []
    ): void
    {
        $this->addRoute('PATCH', $path, $handler, $middleware, $constraints);
    }

    public function delete(
        string $path,
        callable $handler,
        array $middleware = [],
        array $constraints = []
    ): void
    {
        $this->addRoute('DELETE', $path, $handler, $middleware, $constraints);
    }



    private function addRoute(
        string $method,
        string $path,
        callable $handler,
        array $middleware = [],
        array $constraints = []
    ): void {
        $this->routes[$method][$path] = [
            'handler' => $handler,
            'middleware' => $middleware,
            'constraints' => $constraints,
        ];
    }

    private function getParameterPattern(
        string $parameterName,
        array $constraints
    ): string {
        $constraint = $constraints[$parameterName] ?? null;

        return match ($constraint) {
            null, 'string' => '[^/]+',
            'int' => '-?[0-9]+',
            default => throw new InvalidArgumentException(
                "Unsupported route parameter type: {$constraint}"
            ),
        };
    }

    public function run(): void


{
    // Получаем HTTP-метод
    $method = $_SERVER['REQUEST_METHOD'];

    // Получаем путь и query-параметры из URL
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/'; // url
    $path = parse_url($requestUri, PHP_URL_PATH) ?: '/'; // путь

    $queryString = parse_url($requestUri, PHP_URL_QUERY) ?? '';// query-параметры
    $queryParams = []; 

    parse_str($queryString, $queryParams); // преобразуем query-параметры в массив

    $path = rtrim($path, '/');

    if ($path === '') {
        $path = '/';
    }

    $routeFind = false;
    $currentHandler = null ;
    $currentMiddleware = [];


   

    $params = [
        'route' => [],
        'query' => $queryParams,
        'auth' => []
    ];
    

    $methodRoutes = $this->routes[$method] ?? []; // получаем маршруты текущего метода или [] 


    // поиск подходящего под динамические параметры маршрута
    foreach($methodRoutes as $route => $routeDefinition){ 
        // Берём ограничения параметров текущего маршрута.
        $constraints = $routeDefinition['constraints'] ?? [];

        // Превращаем {parameter} в соответствующий шаблон регулярного выражения.
        $routePattern = preg_replace_callback(
            '#\{([^}]+)\}#',
            function (array $matches) use ($constraints): string {
                $parameterName = $matches[1];
                $parameterPattern = $this->getParameterPattern(
                    $parameterName,
                    $constraints
                );

                return '(' . $parameterPattern . ')';
            },
            $route
        );

        if ($routePattern === null) {
            throw new LogicException(
                "Unable to build route pattern for: {$route}"
            );
        }

        $regex = '#^' . $routePattern . '$#';

        // Проверяем, соответствует ли URL текущему маршруту.
        if(preg_match($regex, $path, $matches)){
            $routeFind = true;
            $currentHandler = $routeDefinition['handler'];
            $currentMiddleware = $routeDefinition['middleware'];
            
            // Получаем имена динамических параметров в порядке их появления.
            preg_match_all(
                '#\{[^}]+\}#',
                $route,
                $paramMatches
            );

            $paramSeq = $paramMatches[0]; // массив  упорядоченых параметров

            foreach ($paramSeq as $index => $paramName) {
                // Связываем имя параметра с захваченным значением из URL.
                $paramName = substr($paramName, 1,-1);

                $value = urldecode($matches[$index + 1]);
                $constraint = $constraints[$paramName] ?? null;

                if ($constraint === 'int') {
                    $validatedValue = filter_var(
                        $value,
                        FILTER_VALIDATE_INT
                    );

                    if ($validatedValue === false) {
                        throw new UnexpectedValueException(
                            "Invalid integer route parameter: {$paramName}"
                        );
                    }

                    $value = $validatedValue;
                }

                $params['route'][$paramName] = $value;
            }
            // Подходящий маршрут найден — остальные проверять не нужно.
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