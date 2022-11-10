<?php

namespace Olssonm\EmailAddress;

use Email\Parse;
use Olssonm\EmailAddress\Traits\PartsTrait;
use Olssonm\EmailAddress\Entity\EmailAddress;
use Olssonm\EmailAddress\Exceptions\InvalidEmailAddressException;

class Parser
{
    use PartsTrait;

    public function __construct(readonly string $address)
    {
    }

    public function result(): EmailAddress
    {
        $parseResults = Parse::getInstance()->parse($this->address, false);

        if ($parseResults['invalid']) {
            throw new InvalidEmailAddressException(sprintf('could not parse %s', $this->address), 0);
        }

        return new EmailAddress(
            $parseResults['address'],
            $parseResults['local_part'],
            $this->getDelivery($parseResults['local_part']),
            $this->getTag($parseResults['local_part']),
            $parseResults['domain_part'],
        );
    }
}
