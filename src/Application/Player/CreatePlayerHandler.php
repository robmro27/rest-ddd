<?php

namespace App\Application\Player;

use App\Domain\Player\Player;
use App\Domain\Player\PlayerRepository;
use App\Domain\Player\PlayerRepositoryInterface;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreatePlayerHandler
{

    public function __construct(
        private PlayerRepositoryInterface $playerRepository,
        private UserPasswordHasherInterface $hasher
    ) {}

    /**
     * @throws Exception
     */
    public function handle(array $playerArray)
    {
        $player = new Player();
        $player->setUsername($playerArray['username']);
        $player->setEmail($playerArray['email']);
        $player->setAvatar($playerArray['avatar']);
        $player->setPassword($this->hasher->hashPassword($player, $playerArray['password']));

        try {
            $this->playerRepository->save($player);
        } catch (Exception $exception) {
            throw new Exception('User can not be saved');
        }
    }

}