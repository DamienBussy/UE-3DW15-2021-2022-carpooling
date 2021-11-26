<?php
namespace App\Controllers;

use App\Services\ReservationsService;

class ReservationsController
{
    // Create reservation
    public function createReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['nameReservation']) &&
            isset($_POST['firstDate']) &&
            isset($_POST['endDate'])) {
            // Create the reservation :
            $reservationsService = new ReservationsService();
            $reservationsId = $reservationsService->setReservation(
                null,
                $_POST['nameReservation'],
                $_POST['firstDate'],
                $_POST['endDate'],
            );
            if ($reservationsId)
            {
                $html = 'Réservation créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la réservation.';
            }
        }

        return $html;
    }


    public function getReservations(): string
    {
        $html = '';

        // Get all reservations :
        $reservationsService = new ReservationsService();
        $reservations = $reservationsService->getReservations();

        // Get html :
        foreach ($reservations as $reservation)
        {
            $html .=
                '#' . $reservation->getId() . ' ' .
                $reservation->getnameReservation() . ' ' .
                $reservation->getfirstDate()->format('d-m-Y') . ' ' .
                $reservation->getendDate()->format('d-m-Y') . ' ' .'<br />';
        }

        return $html;
    }

    //Update reservation
    public function updateReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['nameReservation']) &&
            isset($_POST['firstDate']) &&
            isset($_POST['endDate'])) {
            // Update the user :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                $_POST['id'],
                $_POST['nameReservation'],
                $_POST['firstDate'],
                $_POST['endDate'],
            );
            if ($isOk) {
                $html = 'Réservation mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la réservation.';
            }
        }

        return $html;
    }

    // Delete Reservation
    public function deleteReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->deleteReservation($_POST['id']);
            if ($isOk) 
            {
                $html = 'Réservation supprimé avec succès.';
            } else 
            {
                $html = 'Erreur lors de la supression de la réservation.';
            }
        }

        return $html;
    }
}

?>