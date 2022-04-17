<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Team\Team;
use App\Domain\Team\TeamRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class TeamRepository extends ServiceEntityRepository implements TeamRepositoryInterface
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Team::class);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(Team $team)
    {
        $this->_em->persist($team);
        $this->_em->flush();
    }

}