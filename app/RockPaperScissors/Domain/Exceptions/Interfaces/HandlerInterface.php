<?php

namespace App\RockPaperScissors\Domain\Exceptions\Interfaces;

interface HandlerInterface
{
    public function render($handler, $exception, $extraInfo);
}