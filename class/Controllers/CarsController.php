<?php

namespace App\Controllers;

use App\Services\CarsService;

class CarsController
{
    public function createCar(): string {

        $html='';
        if(isset($_POSt['brand']) && 
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['nbrSlots'])
        )

        // Create the car :
        $carsService = new CarsService();
        $carId = $carsService->setCar(
            null,
            $_POST['brand'],
            $_POST['model'],
            $_POST['color'],
            $_POST['nbrSlots'],
        );

        if($carId)
        {
            $html="Le véhicule vient d'être ajouté";
        }
        else{
            $html="Le véhicule n'a pas pu être ajouté";
        }
        return $html;

    }

    public function updateCar():string {
        $html='';

        if(isset($_POSt['brand']) && 
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['nbrSlots'])
        ){
        $carsService=new CarsService();
        $isOk = $carsService->setCar(
            $_POST['id'],
            $_POST['brand'],
            $_POST['model'],
            $_POST['color'],
            $_POST['nbrSlots']
        );
        if ($isOk) {
            $html = 'Le véhicule est mis à jour avec succès.';
        } else {
            $html = 'Erreur lors de la mise à jour du véhicule.';
        }
    }
    return $html;

    }

    public function deleteCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the user :
            $carsService = new CarsService();
            $isOk = $carsService->deleteCar($_POST['id']);
            if ($isOk) {
                $html = 'Véhicule supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression du véhicule.';
            }
        }

        return $html;
    }



public function getCars(): string
    {
        $html = '';

        // Get all users :
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html :
        foreach ($cars as $car){
            $html .=
                '#' . $car->getId() . ' ' .
                $car->getBrand() . ' ' .
                $car->getModel() . ' ' .
                $car->getColor() . ' ' .
                $car->getNbrSlots(). ' ' .'<br />';
                
        }

        return $html;
    }

}
?>