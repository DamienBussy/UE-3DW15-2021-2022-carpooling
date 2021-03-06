<?php

namespace App\Entities;

class Annonce
{
    private $id;
    private $titre;
    private $prix;
    private $reservations;
    private $cars;
    
    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrix(): string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getReservations(): string
    {
        return $this->reservations;
    }

    public function setReservations(string $reservations): self
    {
        $this->reservations = $reservations;

        return $this;
    }

    public function getCars(): string
    {
        return $this->cars;
    }

    public function setCars(string $cars): self
    {
        $this->cars = $cars;

        return $this;
    }
}