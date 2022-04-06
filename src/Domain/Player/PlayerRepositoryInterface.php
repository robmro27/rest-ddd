<?php

namespace App\Domain\Player;

interface PlayerRepositoryInterface
{
    public function save(Player $player);
}