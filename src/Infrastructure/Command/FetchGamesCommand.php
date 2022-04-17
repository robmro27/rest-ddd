<?php

namespace App\Infrastructure\Command;

use App\Domain\League\League;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchGamesCommand extends Command
{
    private CreateGameHandler $createGameHandler;
    private FetchGamesInterface $fetchGames;

    protected static $defaultName = 'app:fetch-games';

    public function __construct(
        CreateGameHandler $createGameHandler,
        FetchGamesInterface $fetchGames)
    {
        $this->createGameHandler = $createGameHandler;
        $this->fetchGames = $fetchGames;

        parent::__construct();
    }

    protected function configure(): void
    {
        parent::configure();

        $this->addArgument('days', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $games = $this->fetchGames->fetch(
            [
                'days' => $input->getArgument('days')
            ]
        );

        foreach ($games as $game) {
            try {
                $this->createGameHandler->handle($game);
                $output->writeln($game['homeTeam']. ' - ' . $game['awayTeam'] . ' games are saved');
            } catch (Exception $exception) {
                $output->writeln($exception->getMessage());
            }
        }

        $output->writeln('Games are created');

        return Command::SUCCESS;
    }
}