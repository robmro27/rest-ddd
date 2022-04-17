<?php

namespace App\Infrastructure\Services;

class FetchTeams implements FetchTeamsInterface
{

    public function __construct(private ProviderInterface $provider)
    {}


    public function fetch(array $input): array
    {
        $teams = $this->provider->getContent($input);

        $teamsArr = [];

        foreach ($teams['api']['teams'] as $team) {
            $teamsArr[] = [
                'name' => $team['name'],
                'logo' => $team['logo']
            ];
         }

        return $teamsArr;
    }

}