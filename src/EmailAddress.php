<?php

declare(strict_types=1);

namespace Olssonm\EmailAddress;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\NoRFCWarningsValidation;
use Egulias\EmailValidator\Validation\RFCValidation;
use Olssonm\EmailAddress\Entity\EmailAddress as EntityEmailAddress;

class EmailAddress
{
    public static function parse(string $address): EntityEmailAddress
    {
        $parser = new Parser($address);
        return $parser->result();
    }

    public static function build(): Builder
    {
        return new Builder();
    }

    public static function validate(string $address, $dns = false): bool
    {
        $validator = new EmailValidator();
        return $validator->isValid($address, new MultipleValidationWithAnd([
            new RFCValidation(),
            new NoRFCWarningsValidation()
        ]));
    }
}
