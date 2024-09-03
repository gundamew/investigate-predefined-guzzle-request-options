# Investigate the predefined Guzzle request options

**tl;dr**

Use the predefined request options for the three `Content-Type`s below instead of manually setting them with the `headers` option. Otherwise, the responses will be unexpected.

* `application/json`
* `application/x-www-form-urlencoded`
* `multipart/form-data`

## Requirements

* Guzzle 7.7
* Slim 4.10
* Slim PSR-7 1.5

## Installation

```shell
$ composer install
```

## How to use

Start up the built-in PHP server:

```shell
$ php -S localhost:8000 -t public
```

Execute the testing script:

```shell
$ php public/tester.php
```

## References

https://docs.guzzlephp.org/en/stable/request-options.html#json

> This request option does not support customizing the Content-Type header or any of the options from PHP's [json_encode()](http://www.php.net/manual/en/function.json-encode.php) function. If you need to customize these settings, then you must pass the JSON encoded data into the request yourself using the `body` request option and you must specify the correct Content-Type header using the `headers` request option.

In conclusion, the only content type that won't be messed with custom headers is `application/json`.

Please check the source code ([Client::applyOptions](https://github.com/guzzle/guzzle/blob/7.7/src/Client.php)) for more information.
