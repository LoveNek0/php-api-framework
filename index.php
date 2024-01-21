<?php

use Communication\Request;
use Communication\Response;
use Communication\ResponseStatus;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$handlerFiles = glob(__DIR__ . DIRECTORY_SEPARATOR . 'Handlers/*.php');

foreach ($handlerFiles as $file) {
    require_once $file;
}

$handlerClasses = [];
foreach (get_declared_classes() as $className) {
    if (str_starts_with($className, 'Handlers\\')) {
        $handlerClasses[] = $className;
    }
}


foreach ($handlerClasses as $className) {
    $classReflection = new ReflectionClass($className);

    // Проверяем наличие атрибута Handler
    $handlerAttribute = $classReflection->getAttributes('Attributes\Handler')[0] ?? null;
    if ($handlerAttribute) {
        // Получаем переменную из атрибута Handler
        $handlerName = $handlerAttribute->newInstance()->name;

        // Проверяем каждый метод на наличие атрибута Method
        foreach ($classReflection->getMethods() as $method) {
            $methodAttribute = $method->getAttributes('Attributes\Method')[0] ?? null;
            if ($methodAttribute && $method->isStatic()) {
                // Получаем переменную из атрибута Method
                $methodName = $methodAttribute->newInstance()->name;
                if($_SERVER['REQUEST_URI'] == '/' . $handlerName . '.' . $methodName){
                    $data = isset($_POST) && count($_POST) > 0 ? $_POST : (isset($_GET) && count($_GET) > 0 ? $_GET : []);
                    $request = new Request($_SERVER['REQUEST_URI'], $data);
                    $response = $classReflection->getMethod($method->name)->invoke(null, $request);
                    if($response instanceof Response)
                        echo $response->toJson();
                    exit();
                }
            }
        }
    }
}

echo (new Response(ResponseStatus::Error))->toJson();
