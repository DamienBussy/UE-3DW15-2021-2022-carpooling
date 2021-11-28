<?php

namespace App\Services;

use App\Entities\Car;

class AnnoncesService
{

    public function getAnnonce(): array
    {
        $cars = [];

        $dataBaseService = new DataBaseService();
        $annoncesDTO = $dataBaseService->getAnnonce();
        if (!empty($annoncesDTO)) {
            foreach ($annoncesDTO as $annonceDTO) {
                $annonce = new Annonce();
                $annonce->setId($annonceDTO['id']);
                $annonce->setTitre($annonceDTO['titre']);
                $annonce->setPrix($annonceDTO['prix']);
                $annonces[] = $annonce;
            }
        }

        return $annonces;
    }

    public function setAnnonce(string $id, string $titre, int $prix){
        $annonceId = '';

        $dataBaseService = new DataBaseService();

        if (empty($id)) {
            $annonceId = $dataBaseService->createAnnonce($titre, $prix);
        } else {
            $dataBaseService->updateAnnonce($id, $titre, $prix);
            $annonceId = $id;
        }

        return $annonceId;
    }

    public function deleteAnnonce(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAnnonce($id);

        return $isOk;
    }

    public function setAnnonceCar(string $annonceId, string $carId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAnnonceCars($annonceId, $userId);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getAnnoncesCars(string $annonceId): array
    {
        $annonceUsers = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersCarsDTO = $dataBaseService->getAnnoncesCars($annonceId);
        if (!empty($annoncesCarsDTO)) {
            foreach ($annoncescarsDTO as $annonceCarDTO) {
                $car = new Car();
                $car->setId($annonceCarDTO['id']);
                $car->setTitre($annonceCarDTO['titre']);
                $car->setPrix($annonceCarDTO['prix']);
                $annoncesCars[] = $car;
            }
        }

        return $annoncesCars;
    }
}