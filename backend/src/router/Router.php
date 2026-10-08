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

    public function get(string $path, callable $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function patch(string $path, callable $handler): void
    {
        $this->addRoute('PATCH', $path, $handler);
    }

    public function delete(string $path, callable $handler): void
    {
        $this->addRoute('DELETE', $path, $handler);
    }

    private function addRoute(
        string $method,
        string $path,
        callable $handler
    ): void {
        $this->routes[$method][$path] = $handler;
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

    foreach($this->routes[$method] as $route => $handler){
        $routePattern = preg_replace(
            '#\{[^}]+\}#',
            '([^/]+)',
            $route
        );
        $regex = '#^' . $routePattern . '$#';

        if(preg_match($regex, $path, $matches)){
            echo 'RoutFound';
            return;
        }




    }
    

    // Говорим клиенту, что ответ будет JSON
    header('Content-Type: application/json');

    if ($handler === null) {
        http_response_code(404);

        echo json_encode([
            'error' => 'Route not found'
        ]);

        return;
    }

    // Вызываем найденный обработчик
    $result = $handler();

    // Возвращаем его результат как JSON
    echo json_encode($result);
}
}