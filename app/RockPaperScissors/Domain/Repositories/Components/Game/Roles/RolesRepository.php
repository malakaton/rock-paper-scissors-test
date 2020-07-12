<?php

namespace App\RockPaperScissors\Domain\Repositories\Components\Game\Roles;

use App\RockPaperScissors\Domain\Models\Components\Roles\RoleType;

class RolesRepository
{
    protected $roleTypeModel;

    public function __construct()
    {
        $this->roleTypeModel = new RoleType();
    }

    /**
     * Get random role from RoleType model
     *
     * @return int|null
     */
    public function getRandomRole(): ?int
    {
        return $this->roleTypeModel->getTypes()[array_rand($this->roleTypeModel->getTypes())]['id'] ?? null;
    }

    /**
     * Get total number of roles
     *
     * @return int
     */
    public function getTotalNumRoles(): int
    {
        return count($this->roleTypeModel->getTypes());
    }
}