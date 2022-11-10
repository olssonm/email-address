<?php

namespace Olssonm\EmailAddress;

use Olssonm\EmailAddress\EmailAddress as EmailAddressEmailAddress;
use Olssonm\EmailAddress\Entity\EmailAddress;
use Olssonm\EmailAddress\Traits\PartsTrait;

class Builder
{
    use PartsTrait;

    public function __construct(
        private ?string $address = null,
        private ?string $local = null,
        private ?string $delivery = null,
        private ?string $tag = null,
        private ?string $domain = null,
    ) {
    }

    public function address(string $address): self
    {
        $parsed = EmailAddressEmailAddress::parse($address);

        $this->address = $parsed->address;
        $this->local = $parsed->local;
        $this->delivery = $parsed->delivery;
        $this->tag = $parsed->tag;
        $this->domain = $parsed->domain;

        return $this;
    }

    public function local(string $local)
    {
        $this->local = $local;
        $this->delivery = $this->getDelivery($local);
        $this->tag = $this->getTag($local);
        return $this;
    }

    public function delivery(string $delivery)
    {
        $this->delivery = $delivery;
        return $this;
    }

    public function tag(mixed $tag)
    {
        $this->tag = $tag;
        return $this;
    }

    public function domain(string $domain)
    {
        $this->domain = $domain;
        return $this;
    }

    public function get()
    {
        return new EmailAddress(
            $this->buildAddress(),
            $this->buildLocal(),
            $this->delivery,
            $this->tag,
            $this->domain,
        );
    }

    public function __toString()
    {
        return $this->get()->address;
    }

    private function buildLocal()
    {
        return sprintf(
            '%s%s',
            $this->delivery,
            $this->tag ? '+' . $this->tag : ''
        );
    }

    private function buildAddress()
    {
        return sprintf(
            '%s@%s',
            $this->buildLocal(),
            $this->domain,
        );
    }
}
