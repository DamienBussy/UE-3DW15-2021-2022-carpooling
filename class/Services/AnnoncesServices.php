<?php

namespace App\Services;

//use App\Services\DataBaseService;
use App\Entities\Annonce;
use App\Entities\Reservation;
use App\Entities\Car;
use DateTime;

class AnnoncesService
{

    public function getAnnonces(): array
    {
        $annonces = [];

        $dataBaseService = new DataBaseService();
        $annoncesDTO = $dataBaseService->getAnnonces();
        if (!empty($annoncesDTO)) 
        {
            foreach ($annoncesDTO as $annonceDTO)
            {
                $annonce = new Annonce();
                $annonce->setId($annonceDTO['id']);
                $annonce->setTitre($annonceDTO['titre']);
                $annonce->setPrix($annonceDTO['prix']);
                $annonces[] = $annonce;
            }
        }

        return $annonces;
    }

    public function setAnnonce(?string $id, string $titre, int $prix): string
    {
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

    public function setAnnonceReservation(string $annonceId, string $reservationID): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserAnnonce($annonceId, $reservationID);

        return $isOk;
    }

    /**
     * Get reservations of given user id.
     */
    public function getAnnonceReservations(string $annonceId): array
    {
        $AnnonceReservation = [];

        $dataBaseService = new DataBaseService();

        // Get relation annonces and reservation :
        $annonceReservationsDTO = $dataBaseService->getUserAnnonces($annonceId);
        if (!empty($annonceReservationsDTO)) {
            foreach ($annonceReservationsDTO as $annonceReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($annonceReservationDTO['id']);
                $reservation->setnameReservation($annonceReservationDTO['nameReservation']);
                $date = new DateTime($annonceReservationDTO['firstDate']);
                if ($date !== false) 
                {
                    $reservation->setfirstDate($date);
                }
                $date = new DateTime($annonceReservationDTO['endDate']);
                if ($date !== false) 
                {
                    $reservation->setendDate($date);
                }
                $AnnonceReservation[] = $reservation;
            }
        }
        return $AnnonceReservation;
    }

    public function setAnnonceCar(string $annonceId, string $carId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAnnonceCar($annonceId, $carId);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getAnnoncesCars(string $annonceId): array
    {
        $annoncesCars = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $annoncesCarsDTO = $dataBaseService->getAnnoncesCars($annonceId);
        if (!empty($annoncesCarsDTO)) 
        {
            foreach ($annoncesCarsDTO as $annonceCarDTO) 
            {
                $car = new Car();
                $car->setId($annonceCarDTO['id']);
                $car->setBrand($annonceCarDTO['brand']);
                $car->setModel($annonceCarDTO['model']);
                $car->setColor($annonceCarDTO['color']);
                $car->setNbrSlots($annonceCarDTO['nbrSlots']);
                $annoncesCars[] = $car;
            }
        }

        return $annoncesCars;
    }
}