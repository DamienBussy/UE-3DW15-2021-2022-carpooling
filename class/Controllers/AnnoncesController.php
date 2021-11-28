<?php
namespace App\Controllers;

use App\Services\AnnoncesService;

class AnnoncesController
{
    /**
     * Return the html for the create action. WIP.
     */
    public function createAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['titre'])
            && isset($_POST['prix'])) {
            // Create the notice:
            $annonceService = new AnnoncesService();
            $annonceId = $annonceService->setAnnonce(
                null,
                $_POST['titre'],
                $_POST['prix']
            );

            if ($annonceId) {
                $html = 'Annonce créée avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getAnnonces(): string
    {
        $html = '';

        // Get all notices :
        $annoncesService = new AnnoncesService();
        $annonces = $annoncesService->getAnnonces();

        
        // Get html :
        foreach ($annonces as $annonce)
        {
            $html .=
                '#' . $annonce->getId() . ' ' .
                $annonce->getTitre() . ' ' .
                $annonce->getPrix() . ' ' .'<br />';
                
        }

        return $html;
    }

    /**
     * Update the notice.
     */
    public function updateAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])
            && isset($_POST['titre'])
            && isset($_POST['prix'])) {
            // Update the notice :
            $annonceService = new AnnoncesService();
            $isOk = $annonceService->setAnnonce(
                $_POST['id'],
                $_POST['titre'],
                $_POST['prix']
            );
            if ($isOk) {
                $html = 'Annonce mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Delete a notice.
     */
    public function deleteAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the notice :
            $annonceService = new AnnoncesService();
            $isOk = $annonceService->deleteAnnonce($_POST['id']);
            if ($isOk) {
                $html = 'Annonce supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'annonce.';
            }
        }

        return $html;
    }
}