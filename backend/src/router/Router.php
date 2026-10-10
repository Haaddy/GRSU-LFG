<?php
// TODO  1. Получить method
// 2. Получить path

// 3. Найти все routes для этого method

// 4. Перебрать routes

// 5. Для каждого route:
//    - проверить, совпадает ли path
//    - если совпадает → получить параметры
//    - вызвать handler с параметрами

// 6. Если ничего не совпало → 404
// routes [
// get:[
//     url: handler
//  ]
//]  

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

    // Получаем путь из URL
    $path = parse_url(
        $_SERVER['REQUEST_URI'],
        PHP_URL_PATH
    );

    // Ищем обработчик для этого метода и пути
    // $handler = $this->routes[$method][$path] ?? null;

    $routeFind = false;
    $currentHandler = null ;
    $currentMiddleware = [];

    $params = [];
    


    // поиск подходящего под динамические параметры маршрута
    foreach($this->routes[$method] as $route => $routeDefinition){
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
                $params[$paramName] = $matches[$index + 1];
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

    // Вызываем найденный обработчик

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
        }
    }

    

    $result = $currentHandler($params);

    // Возвращаем его результат как JSON
    echo json_encode($result);
}
}