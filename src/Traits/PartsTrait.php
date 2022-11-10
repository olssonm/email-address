<?php

namespace Olssonm\EmailAddress\Traits;

trait PartsTrait
{
    private function getDelivery($local)
    {
        return explode('+', $local, 2)[0];
    }

    private function getTag($local)
    {
        return explode('+', $local, 2)[1] ?? null;
    }
}
