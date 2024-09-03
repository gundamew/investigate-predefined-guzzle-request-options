<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->post('/test', function (Request $request, Response $response) {
    $response->getBody()->write(json_encode($request->getHeaders(), JSON_PRETTY_PRINT));
    $response->getBody()->write("\n=======\n");
    $response->getBody()->write(json_encode($request->getBody()->getContents(), JSON_PRETTY_PRINT));
    $response->getBody()->write("\n=======\n");
    $response->getBody()->write(json_encode((array)$request->getParsedBody(), JSON_PRETTY_PRINT));
    $response->getBody()->write("\n=======\n");
    $uploadedFiles = $request->getUploadedFiles();
    $filesInfo = ['is_file_uploaded' => isset($uploadedFiles['bar']) && $uploadedFiles['bar'] instanceof Slim\Psr7\UploadedFile];
    $response->getBody()->write(json_encode($filesInfo, JSON_PRETTY_PRINT));
    return $response;
});

$app->run();
