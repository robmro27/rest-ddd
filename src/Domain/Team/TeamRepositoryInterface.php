<?php

namespace App\Domain\Team;

interface TeamRepositoryInterface
{
    public function save(Team $team);
}