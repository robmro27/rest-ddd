<?php

namespace App\Application\Handler\Team;

use App\Application\Services\FileUploaderInterface;
use App\Domain\Team\Team;
use App\Domain\Team\TeamRepositoryInterface;
use Exception;

class CreateTeamHandler
{

    public function __construct(
        private TeamRepositoryInterface $teamRepository,
        private FileUploaderInterface $fileUploader)
    {
    }

    /**
     * @throws Exception
     */
    public function handle(array $team): void
    {
        if ($this->teamRepository->findOneBy(['name' => $team['name']])) {
            throw new Exception('Team already saved');
        }

        if (!isset($team['logo'])) {
            throw new Exception('We need team logo to save the team');
        }

        try {
            $this->fileUploader->upload('guess-team-logos', $team['name'], $team['logo']);
        } catch (Exception $exception) {
            throw new Exception('Cant upload the logo: ' . $exception);
        }

        $this->teamRepository->save((new Team())
            ->setName($team['name'])
            ->setLogo($team['logo'])
        );
    }
}