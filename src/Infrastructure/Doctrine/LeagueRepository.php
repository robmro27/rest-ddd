<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\League\League;
use App\Domain\League\LeagueRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class LeagueRepository extends ServiceEntityRepository implements LeagueRepositoryInterface
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, League::class);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(League $league)
    {
        $this->_em->persist($league);
        $this->_em->flush();
    }

}