<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;

require __DIR__ . '/../vendor/autoload.php';

$client = new Client(['base_uri' => 'http://localhost:8000/']);

$optionsForm = [
    '1-suggest' => [  // success
        'form_params' => ['foo' => 'bar', 'baz' => ['hi', 'there!']],
    ],
    '2-custom-body' => [  // success, malformed data ($request->getParsedBody(), $request->getBody()->getContents())
        'body' => json_encode(['foo' => 'bar', 'baz' => ['hi', 'there!']]),
        'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
    ],
];

$optionsMultipart = [
    '1-suggest' => [  // success
        'multipart' => [
            ['name' => 'foo', 'contents' => 'data'],
            ['name' => 'bar', 'contents' => Utils::tryFopen(__DIR__ . '/white-100.png', 'r')],
        ],
    ],
    '2-custom-header' => [  // request success, upload file fail
        'multipart' => [
            ['name' => 'foo', 'contents' => 'data'],
            ['name' => 'bar', 'contents' => Utils::tryFopen(__DIR__ . '/white-100.png', 'r')],
        ],
        'headers' => ['Content-Type' => 'multipart/form-data; boundary=foo'],
    ],
    '3-custom-body' => [  // request success, upload file fail
        'body' => json_encode([
            ['name' => 'foo', 'contents' => 'data'],
            ['name' => 'bar', 'contents' => Utils::tryFopen(__DIR__ . '/white-100.png', 'r')],
        ]),
        'headers' => ['Content-Type' => 'multipart/form-data; boundary=foo'],
    ],
    '4-different-header' => [  // request success, upload file fail
        'multipart' => [
            ['name' => 'foo', 'contents' => 'data'],
            ['name' => 'bar', 'contents' => 'file'],
        ],
        'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
    ],
];

$optionsJson = [
    '1-suggest' => [  // success
        'json' => ['foo' => 'bar'],
    ],
    '2-custom-body' => [  // success
        'body' => json_encode(['foo' => 'bar']),
        'headers' => ['Content-Type' => 'application/json'],
    ],
];

$response = $client->request('POST', 'test', $optionsForm['1-suggest']);

print_r($response->getBody()->getContents() . "\n");
