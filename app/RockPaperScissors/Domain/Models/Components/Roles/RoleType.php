<?php

namespace App\RockPaperScissors\Domain\Models\Components\Roles;

class RoleType
{
    public const ROCK = 1;
    public const PAPER = 2;
    public const SCISSOR = 3;

    public function getTypes(): array
    {
        return [
            [ 'id' => self::ROCK, 'name' => __("components.roles.rock")],
            [ 'id' => self::PAPER, 'name' => __("components.roles.paper")],
            [ 'id' => self::SCISSOR, 'name' => __("components.roles.scissor")],
        ];
    }
}
