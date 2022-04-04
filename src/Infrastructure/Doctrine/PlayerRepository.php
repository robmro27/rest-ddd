<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Player\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PlayerRepository extends ServiceEntityRepository implements \App\Domain\Player\PlayerRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Player::class);
    }

}