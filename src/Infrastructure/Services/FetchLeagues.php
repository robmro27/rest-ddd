<?php

namespace App\Infrastructure\Services;

use Symfony\Component\String\Slugger\AsciiSlugger;

class FetchLeagues implements FetchLeaguesInterface
{

    public function __construct(private ProviderInterface $provider) {}

    public function fetch(array $input = []): array
    {
        $leagues = $this->provider->getContent($input);

        $leagueArr = [];

        foreach ($leagues['api']['leagues'] as $league) {

            if (strtolower((new AsciiSlugger())->slug($league['name'])->toString()) != 'premier-league') {
                continue;
            }

            if ('England' !== $league['country']) {
                continue;
            }

            $leagueArr[] = [
                'leagueApiId' => $league['league_id'],
                'name' => $league['name'],
                'logo' => $league['logo'],
                'leagueNameSlugged' => strtolower((new AsciiSlugger())->slug($league['name'])->toString())
            ];
        }

        return $leagueArr;
    }

}