<?php

namespace App\DataFixtures;

use App\Domain\League\League;
use App\Domain\Player\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $league = new League();
        $league->setId(1);
        $league->setName('Premier League');
        $league->setLeagueNameSlugged('premier-league');
        $league->setLogo('premier-league-logo.png');
        $league->setLeagueApiId(123);

        $manager->persist($league);

        $player = new Player();
        $player->setUsername('test');
        $player->setEmail('test@test.com');
        $player->setPassword($this->hasher->hashPassword($player, 'test'));

        $manager->persist($player);

        $manager->flush();
    }
}
