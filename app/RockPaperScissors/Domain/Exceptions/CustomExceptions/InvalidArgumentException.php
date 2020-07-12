<?php

namespace App\RockPaperScissors\Domain\Exceptions\CustomExceptions;

use App\RockPaperScissors\Domain\Exceptions\Interfaces\HandlerInterface;
use App\RockPaperScissors\UI\Api\Resources\ExceptionResource;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class InvalidArgumentException extends HttpException implements HandlerInterface
{
    public function render($handler, $exception, $extraInfo)
    {
        $message = is_array($exception->getMessage()) ?: [$exception->getMessage()];

        return (new ExceptionResource($handler, $message, $extraInfo))
            ->response()
            ->setStatusCode(Response::HTTP_BAD_REQUEST);
    }
}
