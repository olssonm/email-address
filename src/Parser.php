<?php

namespace Olssonm\EmailAddress;

use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\EmailParser;
use Olssonm\EmailAddress\EmailAddress as EmailAddressEmailAddress;
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
        $parser = new EmailParser(new EmailLexer());
        $parser->parse($this->address);

        if (
            !$parser->getLocalPart() ||
            !$parser->getDomainPart() ||
            EmailAddressEmailAddress::validate($this->address) === false
        ) {
            throw new InvalidEmailAddressException($this->address);
        }

        return new EmailAddress(
            $this->address,
            $parser->getLocalPart(),
            $this->getDelivery($parser->getLocalPart()),
            $this->getTag($parser->getLocalPart()),
            $parser->getDomainPart(),
        );
    }
}
