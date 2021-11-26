<?php

namespace App\Entities;

use DateTime;

class Reservation
{
    private $id;
    private $nameReservation;
    private $firstDate;
    private $endDate;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getnameReservation(): string
    {
        return $this->nameReservation;
    }

    public function setnameReservation(string $nameReservation): void
    {
        $this->nameReservation = $nameReservation;
    }

    public function getfirstDate(): DateTime
    {
        return $this->firstDate;
    }

    public function setfirstDate(DateTime $firstDate): void
    {
        $this->firstDate = $firstDate;
    }

    public function getendDate(): DateTime
    {
        return $this->endDate;
    }

    public function setendDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }
}
