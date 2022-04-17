<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Game\Game;
use App\Domain\Game\GameRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class GameRepository extends ServiceEntityRepository implements GameRepositoryInterface
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Game::class);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(Game $game)
    {
        $this->_em->persist($game);
        $this->_em->flush();
    }

}