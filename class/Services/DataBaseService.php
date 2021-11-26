<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): string
    {
        $userId = '';

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $userId = $this->connection->lastInsertId();
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }

    // Create a reservation
    public function createReservation(string $nameReservation, DateTime $firstDate, DateTime $endDate): string
    {
        $reservationId = '';

        $data = [
            'nameReservation' => $nameReservation,
            'firstDate' => $firstDate->format(DateTime::RFC3339),
            'endDate' => $endDate->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO reservations (nameReservation, firstDate, endDate) VALUES (:nameReservation, :firstDate, :endDate)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk)
        {
            $reservationId = $this->connection->lastInsertId();
        }
        return $reservationId;
    }

    // Return all reservations
    public function getReservations(): array
    {
        $reservations = [];

        $sql = 'SELECT * FROM reservations';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $reservations = $results;
        }

        return $reservations;
    }

    // Update reservation
    public function updateReservation(string $id, string $nameReservation, DateTime $firstDate, DateTime $endDate): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'nameReservation' => $nameReservation,
            'firstDate' => $firstDate->format(DateTime::RFC3339),
            'endDate' => $endDate->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE reservations SET nameReservation = :nameReservation, firstDate = :firstDate, endDate = :endDate WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    // Delete reservation
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM reservations WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }


    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN users_cars as uc ON uc.car_id = c.id
            WHERE uc.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userCars = $results;
        }

        return $userCars;
    }

    // Create relation bewteen an user and his reservation.
    public function setUserReservation(string $userId, string $reservationId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'reservationId' => $reservationId,
        ];
        $sql = 'INSERT INTO users_reservations (user_id, reservation_id) VALUES (:userId, :reservationId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    // Get reservation of given user id.
    public function getUserReservations(string $userId): array
    {
        $userReservations = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT r.*
            FROM reservations as r
            LEFT JOIN users_reservations as ur ON ur.reservation_id = r.id
            WHERE ur.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userReservations = $results;
        }

        return $userReservations;
    }

    // Create relation bewteen an user and his annonce.
    public function setUserAnnonce(string $userId, string $annonceId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'annonceId' => $annonceId,
        ];
        $sql = 'INSERT INTO users_annonces (user_id, annonce_id) VALUES (:userId, :annonceId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    // Get annonce of given user id.
    public function getUserAnnonces(string $userId): array
    {
        $userAnnonces = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT a.*
            FROM annonces as a
            LEFT JOIN users_annonces as ua ON ua.annonce_id = a.id
            WHERE ua.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userAnnonces = $results;
        }

        return $userAnnonces;
    }

    // Create relation bewteen an user and his annonce.
    public function setAnnonceReservation(string $annonceId, string $reservationId): bool
    {
        $isOk = false;

        $data = [
            'annonceId' => $annonceId,
            'reservationId' => $reservationId,
        ];
        $sql = 'INSERT INTO annonces_reservations (annonce_id, reservation_id) VALUES (::annonceId, reservationId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    // Get annonce of given reservation id.
    public function getAnnonceReservations(string $annonceId): array
    {
        $annoncesReservation = [];

        $data = [
            'annonceId' => $annonceId,
        ];
        $sql = '
            SELECT *
            FROM reservations as r
            LEFT JOIN annonces_reservations as ar ON ar.reservation_id = r.id
            WHERE ar.annonce_id = :annonceId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annoncesReservation = $results;
        }

        return $annoncesReservation;
    }
}
