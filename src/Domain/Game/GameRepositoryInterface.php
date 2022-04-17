<?php

namespace App\Domain\Game;

interface GameRepositoryInterface
{
    public function save(Game $game);
}