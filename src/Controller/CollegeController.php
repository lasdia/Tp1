<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollegeController extends AbstractController
{
    /**
     * @Route("/college", name="college")
     */
    public function index(): Response
    {
        return $this->render('college/index.html.twig', [
            'controller_name' => 'CollegeController',
        ]);
    }

    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil():Response{
        return $this->render('college/accueil.html.twig',[
            'titre' => 'bienvenue au collège Jean Jaures',
        ]);

    }

    /**
     * @Route("/reglement", name="reglement")
     */
    public function reglement():Response{
        return $this->render('college/reglement.html.twig',[
            'titre' => 'reglement interieur',
        ]);
    }

  
    public function Ajoutermatiere():Response{
        return $this->render('college/AjouterMatiere.html.twig',[
            'titre' => 'Ajouter Matiere',
        ]);
    }

    
    public function AjouterClasse():Response{
        return $this->render('college/AjouterClasse.html.twig',[
            'titre' => 'Ajouter Classe',
        ]);
    }

 
    public function AjouterNote():Response{
        return $this->render('college/AjouterNote.html.twig',[
            'titre' => 'AjouterNote',
        ]);
    }

  
}
