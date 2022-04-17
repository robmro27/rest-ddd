<?php

namespace App\Application\Handler\League;

use App\Domain\League\LeagueRepositoryInterface;

class ListLeagueHandler
{
    public function __construct(private LeagueRepositoryInterface $leagueRepository)
    {
    }

    public function handle(): array
    {
        return $this->leagueRepository->findAll();
    }

}