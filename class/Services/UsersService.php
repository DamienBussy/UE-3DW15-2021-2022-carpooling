<?php

namespace App\Services;

use App\Entities\Car;
use App\Entities\Reservation;
use App\Entities\User;
use DateTime;

class UsersService
{
    /**
     * Create or update an user.
     */
    public function setUser(?string $id, string $firstname, string $lastname, string $email, string $birthday): string
    {
        $userId = '';

        $dataBaseService = new DataBaseService();
        $birthdayDateTime = new DateTime($birthday);
        if (empty($id)) {
            $userId = $dataBaseService->createUser($firstname, $lastname, $email, $birthdayDateTime);
        } else {
            $dataBaseService->updateUser($id, $firstname, $lastname, $email, $birthdayDateTime);
            $userId = $id;
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $dataBaseService = new DataBaseService();
        $usersDTO = $dataBaseService->getUsers();
        if (!empty($usersDTO)) {
            foreach ($usersDTO as $userDTO) 
            {
                // Get user :
                $user = new User();
                $user->setId($userDTO['id']);
                $user->setFirstname($userDTO['firstname']);
                $user->setLastname($userDTO['lastname']);
                $user->setEmail($userDTO['email']);
                $date = new DateTime($userDTO['birthday']);
                if ($date !== false) 
                {
                    $user->setbirthday($date);
                }

                // Get cars of this user :
                $cars = $this->getUserCars($userDTO['id']);
                $user->setCars($cars);

                // Get reservations of this user
                $reservation = $this->getUserReservations($userDTO['id']);
                $user->setReservations($reservation);

                $users[] = $user;
            }
        }

        return $users;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteUser($id);

        return $isOk;
    }

    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserCar($userId, $carId);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersCarsDTO = $dataBaseService->getUserCars($userId);
        if (!empty($usersCarsDTO)) {
            foreach ($usersCarsDTO as $userCarDTO) {
                $car = new Car();
                $car->setId($userCarDTO['id']);
                $car->setBrand($userCarDTO['brand']);
                $car->setModel($userCarDTO['model']);
                $car->setColor($userCarDTO['color']);
                $car->setNbrSlots($userCarDTO['nbrSlots']);
                $userCars[] = $car;
            }
        }

        return $userCars;
    }

    // Create relation bewteen an user and his reservation.
    public function setUserReservation(string $userId, string $reservationId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserReservation($userId, $reservationId);

        return $isOk;
    }

    /**
     * Get reservations of given user id.
     */
    public function getUserReservations(string $userId): array
    {
        $userReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and reservations :
        $usersReservationsDTO = $dataBaseService->getUserReservations($userId);
        if (!empty($usersReservationsDTO)) {
            foreach ($usersReservationsDTO as $userReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($userReservationDTO['id']);
                $reservation->setnameReservation($userReservationDTO['nameReservation']);
                //$reservation->setfirstDate($userReservationDTO['firstDate']);
                //$reservation->setendDate($userReservationDTO['endDate']);
                $date = new DateTime($userReservationDTO['firstDate']);
                if ($date !== false) 
                {
                    $reservation->setfirstDate($date);
                }
                $date = new DateTime($userReservationDTO['endDate']);
                if ($date !== false) 
                {
                    $reservation->setendDate($date);
                }
                $userReservations[] = $reservation;
            }
        }

        return $userReservations;
    }
}
