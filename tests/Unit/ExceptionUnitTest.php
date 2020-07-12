<?php

namespace Tests\Unit;

use App\Exceptions\Handler;
use App\RockPaperScissors\Domain\Exceptions\CustomExceptions\InvalidArgumentException;
use Mockery\Exception\BadMethodCallException;
use Illuminate\Http\Response;
use Tests\TestCase;

class ExceptionUnitTest extends TestCase
{
    /**
     * the strategy, is to run (new handler())->render($request,$exception) to
     * code coverage Handler.php line:  return parent::render($request, $exception);
     *
     * @test
     */
    function thrown_exception_to_cover_the_handler_render(): void
    {
        $request = $this->createMock(\Illuminate\Http\Request::class);
        $handler = new Handler($this->mock(\Illuminate\Container\Container::class));
        $expectedInstance = \Illuminate\Http\Response::class;

        $this->assertInstanceOf(
            $expectedInstance,
            $handler->render($request, $this->mock(BadMethodCallException::class))
        );
    }

    /** @test */
    function throw_invalid_argument_exception(): void
    {
        $request = $this->createMock(\Illuminate\Http\Request::class);
        $handler = new Handler($this->mock(\Illuminate\Container\Container::class));
        $exception = new InvalidArgumentException(Response::HTTP_BAD_REQUEST, 'ko');

        $content = json_decode($handler->render($request, $exception)->content(), true);

        $this->assertEquals( get_class($exception), $content['meta']['exception'] );
        $this->assertFalse($content['meta']['success']);
        $this->assertEmpty($content['data']);
        $this->assertNotEmpty($content['meta']['errors']);
        $this->assertEquals($content['meta']['errors'][0], 'ko');
    }
}
