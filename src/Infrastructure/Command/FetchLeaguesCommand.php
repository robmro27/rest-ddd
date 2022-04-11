<?php

namespace App\Infrastructure\Command;

use App\Application\League\CreateLeagueHandler;
use App\Infrastructure\Services\FetchLeaguesInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchLeaguesCommand extends Command
{
    private CreateLeagueHandler $createLeagueHandler;
    private FetchLeaguesInterface $fetchLeagues;

    protected static $defaultName = 'app:fetch-leagues';

    public function __construct(
        CreateLeagueHandler $createLeagueHandler,
        FetchLeaguesInterface $fetchLeagues,
        string $name = null)
    {
        $this->createLeagueHandler = $createLeagueHandler;
        $this->fetchLeagues = $fetchLeagues;

        parent::__construct($name);
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $leagues = $this->fetchLeagues->fetch([]);

        foreach ($leagues as $league) {
            try {
                $this->createLeagueHandler->handle($league);
                $output->writeln($league['name'] . ' saved');
            } catch (Exception $exception) {
                $output->writeln($exception->getMessage());
            }
        }

        $output->writeln('leagues are created');

        return Command::SUCCESS;
    }
}