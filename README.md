# Email address-parser and -builder

[![Supported PHP-versions](https://img.shields.io/packagist/php-v/olssonm/email-address?style=flat-square)](https://packagist.org/packages/olssonm/email-address)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/olssonm/email-address.svg?style=flat-square)](https://packagist.org/packages/olssonm/email-address)
[![Build Status](https://img.shields.io/github/actions/workflow/status/olssonm/email-address/test.yml?branch=main&style=flat-square&label=tests)](https://github.com/olssonm/email-address/actions?query=workflow%3A%22Run+tests%22)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Simple package where you can extract all the parts of an email address. Among the use cases is the retrieval of the actual delivery-address for a subaddress (i.e. "plus addressing", "tagged addressing" etc.).

Available is also an email address builder to construct an address based on parts – as well as a simple validator (using [egulias/email-validator](https://github.com/egulias/EmailValidator).)

*Note: Currently only subaddresses with `+` is supported, which is used by a vast majority of e-mail providers that support subaddressing.*

## Requirements

This package requires PHP 8.1 or newer.

## Installation

```
composer require olssonm/email-address
```

## Usage

### Parser

``` php
use Olssonm\EmailAddress\EmailAddress;

// Returns a `Olssonm\EmailAddress\Entity\EmailAddress`-instance
$email = EmailAddress::parse('test+tag@example.com');

echo $email->address;
// test+tag@example.com

echo $email->local;
// test+tag

echo $email->delivery;
// test

echo $email->tag;
// tag

echo $email->domain;
// example.com
```

### Builder

``` php
use Olssonm\EmailAddress\EmailAddress;

// Returns a `Olssonm\EmailAddress\Entity\EmailAddress`-instance via `get()`
$email = EmailAddress::build()
    ->delivery('test')
    ->tag('tag')
    ->domain('example.com')
    ->get();

echo $email->address;
// test@example.com
```

A clever usage of the builder is the ability to change and/or remove the subaddressing-part:

``` php
$email = EmailAddress::build()
    ->address('test+tag@example.com')
    ->tag(null)
    ->get()

echo $email->address;
// test@example.com
```

``` php
$email = EmailAddress::build()
    ->address('test+tag@example.com')
    ->tag('mytag')
    ->get()

echo $email->address;
// test+mytag@example.com
```

*Note, the `address()`-method for the builder uses the parser – i.e. an exception may be thrown if the address is invalid.*

### Validator

``` php
use Olssonm\EmailAddress\EmailAddress;

// true
EmailAddress::validate('test@example.com');
```

### Exceptions

If an invalid e-mail address is parsed, an `Olssonm\EmailAddress\Exceptions\InvalidEmailAddressException` will be thrown. A good idea is to validate the e-mail address before parsing it.

## License

The MIT License (MIT). Please see the [LICENSE](LICENSE) for more information.

© 2023 [Marcus Olsson](https://marcusolsson.me).
