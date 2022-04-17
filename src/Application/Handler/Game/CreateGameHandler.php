<?php

namespace App\Application\Handler\Game;

use App\Domain\Game\Game;
use App\Domain\League\LeagueRepositoryInterface;
use App\Domain\Team\TeamRepositoryInterface;
use DateTimeImmutable;
use Exception;

class CreateGameHandler
{

    public function __construct(
        private TeamRepositoryInterface $teamRepository,
        private LeagueRepositoryInterface $leagueRepository,
        private GameRepositoryInterface $gameRepository
    ) {}

    /**
     * @throws Exception
     */
    public function handle(array $game)
    {
        $homeTeam = $this->teamRepository->findOneBy(['name' => $game['homeTeam']]);
        $awayTeam = $this->teamRepository->findOneBy(['name' => $game['awayTeam']]);
        $league = $this->leagueRepository->findOneBy(['leagueApiId' => $game['leagueApiId']]);

        if (!$homeTeam) {
            throw new Exception($game['awayTeam'] . ' is not the part of our database');
        }

        if (!$awayTeam) {
            throw new Exception($game['awayTeam'] . ' is not the part of our database');
        }

        if (!$league) {
            throw new Exception($game['leagueApiId'] . ' league is not part of our database');
        }

        $gameTime = new DateTimeImmutable($game['gameTime']);

        $this->gameRepository->save((new Game())
            ->setHomeTeam($homeTeam)
            ->setLeague($league)
            ->setAwayTeam($awayTeam)
            ->setGameTime($gameTime)
        );
    }

}