<?php

namespace Olssonm\EmailAddress\Entity;

class EmailAddress
{
    public function __construct(
        readonly string $address,
        readonly string $local,
        readonly string $delivery,
        readonly ?string $tag = null,
        readonly ?string $domain = null,
    ) {
        # code...
    }
}
