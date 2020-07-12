<?php

namespace Tests\Unit\Services\Components\Game;

use App\RockPaperScissors\Domain\Exceptions\CustomExceptions\InvalidArgumentException;
use App\RockPaperScissors\Domain\Models\Components\Roles\RoleType;
use App\RockPaperScissors\Domain\Repositories\Components\Game\Roles\RolesRepository;
use App\RockPaperScissors\Domain\Services\Components\Game\GameResolverService;
use Tests\TestCase;

class ResolveServiceUnitTest extends TestCase
{
    protected $mockedRolesRepository;
    protected $params;

    public function setUp(): void
    {
        parent::setUp();

        $this->mockedRolesRepository = $this->createMock(RolesRepository::class);
    }
    /**
     * Verify module by zero error
     *
     * @test
     * @covers \App\RockPaperScissors\Domain\Exceptions\CustomExceptions\InvalidArgumentException::render
     */
    public function undefined_players_on_game_exception(): void
    {
        $this->mockedRolesRepository->expects($this->once())
            ->method('getRandomRole')
            ->willReturn(5);

        $this->mockedRolesRepository->expects($this->once())
            ->method('getTotalNumRoles')
            ->willReturn(0);


        $gameResolverService = new GameResolverService($this->mockedRolesRepository, 1);

        $this->expectException(InvalidArgumentException::class);

        $gameResolverService->resolve();
    }

    /**
     * Check that exception is called if get a undefined role from players from role repository
     *
     * @test
     * @covers \App\RockPaperScissors\Domain\Exceptions\CustomExceptions\InvalidArgumentException::render
     * @covers \App\RockPaperScissors\Domain\Services\Components\Game\GameResolverService::whoWins
     */
    public function resolve_match_fails(): void
    {
        $this->mockedRolesRepository->expects($this->once())
            ->method('getRandomRole')
            ->willReturn(RoleType::SCISSOR);

        $serviceReflection = new \ReflectionClass(GameResolverService::class);
        $method = $serviceReflection->getMethod('whoWins');
        $method->setAccessible(true);

        $this->expectException(InvalidArgumentException::class);

        $method->invoke(
            new GameResolverService($this->mockedRolesRepository, 1),
            [
                'firstPlayer' => RoleType::ROCK
            ]
        );
    }
}