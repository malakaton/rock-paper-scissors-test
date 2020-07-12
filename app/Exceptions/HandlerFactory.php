<?php

namespace App\Exceptions;

use App\RockPaperScissors\Domain\Exceptions\CustomExceptions\InvalidArgumentException;

class HandlerFactory
{
    public function initialize($exception)
    {
        switch ($exception) {
            case $exception instanceof InvalidArgumentException:
                return new InvalidArgumentException($exception->getStatusCode(), $exception->getMessage());
            default:
                return null;
        }
    }
}
