<?php

namespace App\Infrastructure\Command;

use App\Domain\League\League;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchTeamsCommand extends Command
{
    private CreateTeamHandler $createTeamHandler;
    private FetchTeamsInterface $fetchTeams;
    private ListLeagueHandler $listLeagueHandler;

    protected static $defaultName = 'app:fetch-teams';

    public function __construct(
        CreateTeamHandler $createTeamHandler,
        FetchTeamsInterface $fetchTeams,
        ListLeagueHandler $listLeagueHandler,
        string $name = null)
    {
        $this->createTeamHandler = $createTeamHandler;
        $this->fetchTeams = $fetchTeams;
        $this->listLeagueHandler = $listLeagueHandler;

        parent::__construct($name);
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $leagues = $this->listLeagueHandler->handle();

        if (!$leagues) {
            $output->writeln('There are no leagues to add teams');
            return Command::FAILURE;
        }

        /** @var League $league */
        foreach ($leagues as $league) {
            if (!$league->getLeagueApiId()) {
                $output->writeln('We need to know rapid api league id');
            }

            $teams = $this->fetchTeams->fetch(
                [
                    'league-api-id' => $league->getLeagueApiId()
                ]
            );

            foreach ($teams as $team) {
                try {
                    $this->createTeamHandler->handle($team);
                } catch (Exception $exception) {
                    $output->writeln($exception->getMessage());
                }
            }
        }

        $output->writeln('Teams are created');

        return Command::SUCCESS;
    }
}