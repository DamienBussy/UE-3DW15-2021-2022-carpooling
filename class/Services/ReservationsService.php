<?php
namespace App\Services;

use DateTime;
use App\Services\DataBaseService;
use App\Entities\Reservation;

Class ReservationsService
{
    // Create or Update réservation
    public function setReservation(?string $id, string $nameReservation, string $firstDate, string $endDate): string
    {
        $reservationId = '';

        $dataBaseService = new DataBaseService();
        $firstDateDateTime = new DateTime($firstDate);
        $endDateDateTime = new DateTime($endDate);
        if (empty($id)) {
            $reservationId = $dataBaseService->createReservation($nameReservation, $firstDateDateTime, $endDateDateTime);
        } else {
            $dataBaseService->updateReservation($id, $nameReservation, $firstDateDateTime, $endDateDateTime);
            $reservationId = $id;
        }

        return $reservationId;
    }


    // Return all reservations R->Read
    public function getReservations(): array
    {
        $reservations = [];

        $dataBaseService = new DataBaseService();
        $reservationsDTO = $dataBaseService->getReservations();
        if (!empty($reservationsDTO))
        {
            foreach ($reservationsDTO as $reservationDTO)
            {
                // Get reservation :
                $reservation = new Reservation();
                $reservation->setId($reservationDTO['id']);
                $reservation->setnameReservation($reservationDTO['nameReservation']);
                $date1 = new DateTime($reservationDTO['firstDate']);
                $date2 = new DateTime($reservationDTO['endDate']);
                if ($date1 !== false && $date2 !== false)
                {
                    $reservation->setfirstDate($date1);
                    $reservation->setendDate($date2);
                }

                $reservations[] = $reservation;
            }
        }

        return $reservations;
    }

    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteReservation($id);

        return $isOk;
    }
}
?>