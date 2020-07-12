<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Add the exception class name, message and stack trace to response
     *
     * @param \Exception $exception
     * @return array
     */
    private function getExtraInfo(Exception $exception) : array
    {
        return (config('app.debug') || config('app.env') === 'local')
            ?   [
                'meta' => [
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile() . ' at line: ' . $exception->getLine(),
                    'exception' => get_class($exception),
                ],
            ]
            : [];
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        $extraInfo = $this->getExtraInfo($exception);
        $handlerFactory = new HandlerFactory();
        $handlerException = $handlerFactory->initialize($exception);

        return $handlerException
            ? $handlerException->render($this, $exception, $extraInfo)
            : parent::render($request, $exception);
    }
}
