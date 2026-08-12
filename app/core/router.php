 <?php
 
 $routes = [
        '/' => [
            'controller' => 'notecontroller',
            'action' => 'getTable'
         ],
        '/login' => [
            'controller' => 'authcontroller',
             'action' => 'login'
        ],'/logout' => [
            'controller' => 'authcontroller',
             'action' => 'logout'
        ]
    ];

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if(!isset($routes[$uri])){

        http_response_code(404);
        echo "Page introuvable";
        exit;
    }

    $controller = $routes[$uri]['controller'];
    $action = $routes[$uri]['action'];
    if(file_exists(dirname(__DIR__)."/controller/$controller.php")){
        require_once dirname(__DIR__)."/controller/$controller.php";
        if(function_exists($action)){
            $action();
        }
    } else {
        http_response_code(404);
        echo "Not found";
    }
