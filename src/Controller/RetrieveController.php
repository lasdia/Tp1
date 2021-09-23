<?php

namespace App\Controller;

use App\Entity\Prof;
use App\Entity\Eleve;
use App\Entity\Classe;
use App\Repository\NoteRepository;
use App\Repository\ProfRepository;
use App\Repository\EleveRepository;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RetrieveController extends AbstractController
{
    /**
     * @Route("/retrieve", name="retrieve")
     */
    public function index(): Response
    {
        return $this->render('retrieve/index.html.twig', [
            'controller_name' => 'RetrieveController',
        ]);
    }

    //pour que ça marche partir de la classe car cest la foreign key la + éloigné
     /**
     * @Route("/profRetrieve", name="profRetrieve")
     */
    public function RetrieveclasseProfsMatiere(ClasseRepository $repository): Response
    {
        $Classe = $repository->findAll();
       

        return $this->render('retrieve/profRetrieve.html.twig', [
            'classes' => $Classe
            
        ]);
    }


      /**
     * @Route("/eleveRetrieve", name="eleveRetrieve")
     */
    public function RetrieveEleves(EleveRepository $repository): Response
    {
        $Eleve= $repository->findAll();
       

        return $this->render('retrieve/eleveRetrieve.html.twig', [
            'eleves' => $Eleve
            
        ]);
    }


       /**
     * @Route("/classeRetrieve", name="classeRetrieve")
     */
    public function Retrieveclasses(ClasseRepository $repository): Response
    {
        $Classe= $repository->findAll();
       

        return $this->render('retrieve/classeRetrieve.html.twig', [
            'classes' => $Classe
            
        ]);
    }

   /**
     * @Route("/profs/{id}", name="delete_prof")
     */
    public function deleteProf(Prof $prof, EntityManagerInterface $entityManager){

        $entityManager->remove($prof);
        $entityManager->flush();

        return $this->redirectToRoute('accueil');
    }

     /**
     * @Route("/eleves/{id}", name="delete_eleve")
     */
    public function deleteEleve(Eleve $eleve, EntityManagerInterface $entityManager){

        $entityManager->remove($eleve);
        $entityManager->flush();

        return $this->redirectToRoute('accueil');
    }

      /**
     * @Route("/classes/{id}", name="delete_classe")
     */
    public function deleteClasse(Classe $classe, EntityManagerInterface $entityManager){

        $entityManager->remove($classe);
        $entityManager->flush();

        return $this->redirectToRoute('accueil');

    }



      /**
     * @Route("/eleve/{id}", name="one_eleve")
     */
    public function retrieveOneEleve($id, EleveRepository $repository, NoteRepository $n){

        $eleve = $repository->find($id);
        $note = $n->findBy(['eleve'=>$id]);

        return $this->render('retrieve/oneEleve.html.twig',[
            'eleve2' => $eleve,
            'notes' => $note
        ]);
    }


}
