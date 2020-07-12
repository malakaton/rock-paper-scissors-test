<?php

namespace App\RockPaperScissors\Domain\Services\Components\Game;

use App\RockPaperScissors\Domain\Exceptions\CustomExceptions\InvalidArgumentException;
use App\RockPaperScissors\Domain\Models\Components\Roles\RoleType;
use App\RockPaperScissors\Domain\Repositories\Components\Game\Roles\RolesRepository;
use Illuminate\Http\Response;

class GameResolverService
{
    protected const NUM_GAMES = 100;

    protected $rolesRepository;
    protected $playersOnGames = [];
    protected $numGameWinsFirstPlayer = 0;
    protected $numGameWinsSecondPlayer = 0;
    protected $numGameDraws = 0;

    public function __construct(RolesRepository $rolesRepository, int $numMatches = self::NUM_GAMES)
    {
        $this->rolesRepository = $rolesRepository;

        for ($i = 0; $i < $numMatches; $i++)
        {
            $this->playersOnGames[] = [
                'firstPlayer' => RoleType::ROCK,
                'secondPlayer' => $this->rolesRepository->getRandomRole()
            ];
        }

    }

    /**
     * Build statistics of the matches played
     *
     * @return array|array[]
     */
    public function resolve(): array
    {
        foreach ($this->playersOnGames as $playersGame) {
            $this->whoWins($playersGame);
        }

        return [
            'statistics' => [
                'number of match won' => [
                    'first player' => $this->numGameWinsFirstPlayer,
                    'second player' => $this->numGameWinsSecondPlayer
                ],
                'number of draws on match' => $this->numGameDraws
            ]
        ];
    }


    /**
     * Get the winner of match
     *
     * return 1 if the winner is first player
     * return 2 if the winner is second player
     * return 0 if exist a draw and both players choice rock
     *
     * @param array $playersGame
     * @return void
     */
    protected function whoWins(array $playersGame): void
    {
        try {
            if ($playersGame['firstPlayer'] === (($playersGame['secondPlayer'] + 1) % $this->rolesRepository->getTotalNumRoles(
                    ))) {
                $this->numGameWinsFirstPlayer++;
            }

            if ($playersGame['secondPlayer'] === (($playersGame['firstPlayer'] + 1) % $this->rolesRepository->getTotalNumRoles(
                    ))) {
                $this->numGameWinsSecondPlayer++;
            }

            if ($playersGame['firstPlayer'] === RoleType::ROCK && $playersGame['secondPlayer'] === RoleType::ROCK) {
                $this->numGameDraws++;
            }
        }
        catch (\Exception | \DivisionByZeroError $e)
        {
            throw new InvalidArgumentException(
                Response::HTTP_BAD_REQUEST,
                __('validation.custom.undefined-player')
            );
        }
    }
}