# Email address parser and builder

Simple package where you can parse out all the parts of an email adress. Among the use cases is the retrieval of the actual delivery-address for a subaddress (i.e. "plus addressing", "tagged addressing" etc.).

Available is also an email address builder to construct an address based on parts – as well as a simple validator (using [egulias/email-validator](https://github.com/egulias/EmailValidator).)

*Note:* Currently only subaddresses with `+` is supported, which is used by a vast majority of e-mail providers that support subaddressing.

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

*Note*, the `address()`-method for the builder uses the parser – i.e. an exception may be thrown if the address is invalid.

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

© 2022 [Marcus Olsson](https://marcusolsson.me).
