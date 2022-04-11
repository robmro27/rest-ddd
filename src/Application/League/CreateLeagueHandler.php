<?php

namespace App\Application\League;


use App\Application\Services\FileUploaderInterface;
use App\Domain\League\League;
use App\Domain\League\LeagueRepositoryInterface;
use Exception;

class CreateLeagueHandler
{

    public function __construct(
        private LeagueRepositoryInterface $leagueRepository,
        private FileUploaderInterface $fileUploader
    ) {}

    /**
     * @throws Exception
     */
    public function handle(array $league)
    {
        if ($this->leagueRepository->findOneBy(['name' => $league['name']])) {
            throw new Exception('League already saved');
        }

        if (!isset($league['logo'])) {
            throw new Exception('We need team logo to save league');
        }

        try {
            $this->fileUploader->upload('guess-league-logos', $league['name'], $league['logo']);
        } catch (Exception $exception) {
            throw new Exception('Cant upload the logo: ' . $exception->getMessage());
        }

        $league = new League();
        $league->setName($league['name']);
        $league->setLogo($this->fileUploader->getImageUrl());
        $league->setLeagueApiId($league['leagueApiId']);
        $league->setLeagueNameSlugged($league['leagueNameSlugged']);

        $this->leagueRepository->save($league);
    }

}