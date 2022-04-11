<?php

namespace App\Infrastructure\RapidApi;

use App\Infrastructure\Services\ProviderInterface;
use DateTimeImmutable;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RapidApiClient implements ProviderInterface
{

    const API_FOOTBALL_URI_LEAGUES = 'https:\\api-football-v1.p.rapidapi.com/v2/leagues/season/2020';
    const API_FOOTBALL_URI_TEAMS = 'https:\\api-football-v1.p.rapidapi.com/v2/teams/league';
    const API_FOOTBALL_URI_GAMES = 'https:\\api-football-v1.p.rapidapi.com/v2/fixtures/data/';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client(
            [
                'headers' => [
                    'X-RapidAPI-Key' => 'your-key'
                ]
            ]
        );
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function getContent(array $criteria): float|object|int|bool|array|string|null
    {
        $response = '';

        if (!$criteria) {
            $response = $this->client->request(
                'GET',
                self::API_FOOTBALL_URI_LEAGUES
            );
        }

        if (isset($criteria['league-api-id'])) {
            $response = $this->client->request(
                'GET',
                self::API_FOOTBALL_URI_TEAMS . $criteria['league-api-id']
            );
        }

        if (isset($criteria['days'])) {
            $response = $this->client->request(
                'GET',
                self::API_FOOTBALL_URI_GAMES. (new DateTimeImmutable($criteria['days'] . ' day'))->format('Y-m-d')
            );
        }

        return Utils::jsonDecode(
            $response->getBody()->getContents(), true
        );
    }

}