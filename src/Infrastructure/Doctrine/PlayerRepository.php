<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Player\Player;
use App\Domain\Player\PlayerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class PlayerRepository extends ServiceEntityRepository implements PlayerRepositoryInterface
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Player::class);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(Player $player)
    {
        $this->_em->persist($player);
        $this->_em->flush();
    }

}