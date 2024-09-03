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
