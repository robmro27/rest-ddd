<?php

namespace App\Domain\League;

class League
{
    private int $id;
    private string $name;
    private string $leagueNameSlugged;
    private string $logo;
    private int $leagueApiId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLeagueNameSlugged(): string
    {
        return $this->leagueNameSlugged;
    }

    /**
     * @param string $leagueNameSlugged
     */
    public function setLeagueNameSlugged(string $leagueNameSlugged): void
    {
        $this->leagueNameSlugged = $leagueNameSlugged;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     */
    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return int
     */
    public function getLeagueApiId(): int
    {
        return $this->leagueApiId;
    }

    /**
     * @param int $leagueApiId
     */
    public function setLeagueApiId(int $leagueApiId): void
    {
        $this->leagueApiId = $leagueApiId;
    }


}