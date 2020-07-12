<?php

namespace App\RockPaperScissors\UI\Api\Controllers\Components;

use App\RockPaperScissors\Domain\Repositories\Components\Game\Roles\RolesRepository;
use App\RockPaperScissors\Domain\Services\Components\Game\GameResolverService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class GameController extends BaseController
{
    /**
     * Play a determinate number of match and return a statistics of the matches played
     *
     * @return JsonResponse
     */
    public function play(): JsonResponse
    {
        return response()->json([
            'data' => (new GameResolverService(new RolesRepository()))->resolve(),
            'meta' => [
                'success' => true,
                'errors' => []
            ]
        ]);
    }
}