<?php

namespace App\DataFixtures;

use App\Domain\League\League;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $league = new League();
        $league->setId(1);
        $league->setName('Premier League');
        $league->setLeagueNameSlugged('premier-league');
        $league->setLogo('premier-league-logo.png');
        $league->setLeagueApiId(123);

        $manager->persist($league);

        $manager->flush();
    }
}
