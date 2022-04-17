<?php

namespace App\Domain\League;

interface LeagueRepositoryInterface
{
    public function save(League $league);
    public function findAll(): array;
}