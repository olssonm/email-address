<?php

use Olssonm\EmailAddress\EmailAddress;

it('validates valid addresses', function ($address) {
    expect(EmailAddress::validate($address))->toBe(true);
})->with([
    'simple@example.com',
    'very.common@example.com',
    'disposable.style.email.with+symbol@example.com',
    'other.email-with-hyphen@example.com',
    'fully-qualified-domain@example.com',
]);

it('invalidates invalid addresses', function ($address) {
    expect(EmailAddress::validate($address))->toBe(false);
})->with([
    'Abc.example.com',
    'A@b@c@example.com',
    'a"b(c)d,e:f;g<h>i[j\k]l@example.com',
    'just"not"right@example.com',
    'QA[icon]CHOCOLATE[icon]@test.com',
]);
