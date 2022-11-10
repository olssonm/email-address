<?php

use Olssonm\EmailAddress\EmailAddress;

it('can build normal address', function () {
    $address = EmailAddress::build()
        ->local('test')
        ->domain('example.com')
        ->get();

    expect($address->address)->toBe('test@example.com');
    expect($address->tag)->toBe(null);
});

it('can build tag address', function () {
    $address = EmailAddress::build()
        ->local('test')
        ->tag('tag')
        ->domain('example.com')
        ->get();

    expect($address->address)->toBe('test+tag@example.com');
    expect($address->tag)->toBe('tag');
});

it('can build subdomain address', function () {
    $address = EmailAddress::build()
        ->local('test')
        ->domain('sub.example.com')
        ->get();

    expect($address->address)->toBe('test@sub.example.com');
    expect($address->tag)->toBe(null);
});

it('can build from an complete address', function () {
    $address = EmailAddress::build()
        ->address('test+tag@example.com')
        ->get();

    expect($address->address)->toBe('test+tag@example.com');
    expect($address->tag)->toBe('tag');
});

it('can build from an complete address and change tag', function () {
    $address = EmailAddress::build()
        ->address('test+tag@example.com')
        ->tag('abc123')
        ->get();

    expect($address->address)->toBe('test+abc123@example.com');
    expect($address->tag)->toBe('abc123');
});

it('can build from local part and change tag', function () {
    $address = EmailAddress::build()
        ->local('test+tag')
        ->domain('example.com')
        ->tag('abc123')
        ->get();

    expect($address->address)->toBe('test+abc123@example.com');
    expect($address->tag)->toBe('abc123');
});

it('can build from an complete address and remove tag', function () {
    $address = EmailAddress::build()
        ->address('test+tag@example.com')
        ->tag(null)
        ->get();

    expect($address->address)->toBe('test@example.com');
    expect($address->tag)->toBe(null);
});

it('can can transform to string', function () {
    $address = EmailAddress::build()
        ->local('test')
        ->domain('example.com');

    expect((string) $address)->toBe('test@example.com');
});
