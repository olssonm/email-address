<?php

use Olssonm\EmailAddress\EmailAddress;
use Olssonm\EmailAddress\Exceptions\InvalidEmailAddressException;

it('can parse normal address', function () {
    $parsed = EmailAddress::parse('test@example.com');
    expect($parsed->address)->toBe('test@example.com');
    expect($parsed->local)->toBe('test');
    expect($parsed->delivery)->toBe('test');
    expect($parsed->tag)->toBe(null);
    expect($parsed->domain)->toBe('example.com');
});

it('can parse tag address', function () {
    $parsed = EmailAddress::parse('test+tag@example.com');
    expect($parsed->address)->toBe('test+tag@example.com');
    expect($parsed->local)->toBe('test+tag');
    expect($parsed->delivery)->toBe('test');
    expect($parsed->tag)->toBe('tag');
    expect($parsed->domain)->toBe('example.com');
});

it('can parse subdomain address', function () {
    $parsed = EmailAddress::parse('test@sub.example.com');
    expect($parsed->address)->toBe('test@sub.example.com');
    expect($parsed->local)->toBe('test');
    expect($parsed->delivery)->toBe('test');
    expect($parsed->tag)->toBe(null);
    expect($parsed->domain)->toBe('sub.example.com');
});

it('fails invalid address', function ($address) {
    EmailAddress::parse($address);
})->with([
    'abc.example.com',
    'A@b@c@example.com',
    'a"b(c)d,e:f;g<h>i[j\k]l@example.com',
    'i_like_underscore@but_its_not_allowed_in_this_part.example.com'
])->throws(InvalidEmailAddressException::class);
