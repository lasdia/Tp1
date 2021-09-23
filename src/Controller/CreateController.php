<?php

namespace App\Controller;
use App\Entity\Prof;
use App\Entity\Eleve;
use App\Entity\Classe;
use App\Entity\Matiere;
use App\Entity\Note;
use App\Form\Type\CollegeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateController extends AbstractController
{
    /**
     * @Route("/create", name="create")
     */
    public function index(): Response
    {
        return $this->render('create/index.html.twig', [
            'controller_name' => 'CreateController',
        ]);
    }

     /**
     * @Route("/ajouterProf", name="ajouterProf")
     */
    public function createProf(Request $request, EntityManagerInterface $entityManager){
        $prof = new Prof;
      
    
        $formulaire = $this->createFormBuilder($prof)
            ->add('matiere',EntityType::class,[
                'class' => Matiere::class,
                'choice_label'=> 'nom',
              
            ])

            ->add('nom',TextType::class,[
                'label' => 'Nom'
            ])
            ->add('prenom',TextType::class,[
                'label' => 'Prénom'
            ])
            ->add('datedenaissance',DateType::class,[
                'label'=> 'Date de naissance',
                'input_format' => 'd/m/Y'
            ])

            ->add('submit',SubmitType::class,[
                'label' => 'Envoyer'
            ])
         
            ->getForm();
          
           
            $formulaire->handleRequest($request);
       
            if($formulaire->isSubmitted() && $formulaire->isValid()){
          
                $entityManager->persist($prof);
                $entityManager->flush();

                return $this->redirectToRoute('accueil');
            }else{
                return $this->render('college/ajouterProf.html.twig',[
                    'type' => 'Section Ajouter Un Professeur',
                    'formView' => $formulaire->createView()
                ]);
            }
    }


     /**
     * @Route("/ajouterMatiere", name="ajouterMatiere")
     */
    public function createMatiere(Request $request, EntityManagerInterface $entityManager){
        $matiere = new Matiere;

        $formulaire = $this->createFormBuilder($matiere)
            ->add('nom',TextType::class,[
                'label' => 'Nom'
            ])

            ->add('submit',SubmitType::class,[
                'label' => 'Envoyer'
            ])        

            ->getForm();

            $formulaire->handleRequest($request);

            if($formulaire->isSubmitted() && $formulaire->isValid()){
                
                $entityManager->persist($matiere);
                $entityManager->flush();

                return $this->redirectToRoute('accueil');
            }else{
                return $this->render('college/ajouterMatiere.html.twig',[
                    'type' => "Création d'une nouvelle matiere",
                    'formView' => $formulaire->createView()
                ]);
            }

            
    }

     /**
     * @Route("/ajouterClasse", name="ajouterClasse")
     */
    public function createClasse(Request $request, EntityManagerInterface $entityManager){
        $classe = new Classe;

        $formulaire = $this->createFormBuilder($classe)
            ->add('prof',EntityType::class,[
                'class' => Prof::class,
                'choice_label'=> 'nom',
                'label'=> 'Nom du professeur affilié',
          
        ])
        
            ->add('nom',TextType::class,[
                'label' => 'Nom de la classe'
            ])

            ->add('niveau',TextType::class,[
                'label' => 'Niveau'
            ])

            ->add('submit',SubmitType::class,[
                'label' => 'Envoyer'
            ])        

            ->getForm();

            $formulaire->handleRequest($request);

            if($formulaire->isSubmitted() && $formulaire->isValid()){
                
                $entityManager->persist($classe);
                $entityManager->flush();

                return $this->redirectToRoute('accueil');
            }else{
                return $this->render('college/ajouterClasse.html.twig',[
                    'formView'=> $formulaire->createView()
                ]);
            }

        }

      /**
     * @Route("/ajouterEleve", name="ajouterEleve")
     */
    public function createEleve(Request $request, EntityManagerInterface $entityManager){
        $eleve = new Eleve;
      
        $formulaire = $this->createFormBuilder($eleve)
            ->add('classe',EntityType::class,[
                'class' => Classe::class,
                'choice_label'=> 'nom'
              
            ])

            ->add('nom',TextType::class,[
                'label' => 'nom'
            ])
            ->add('prenom',TextType::class,[
                'label' => 'prenom'
            ])
            ->add('datedenaissance',DateType::class,[
                'label'=> 'Date de naissance',
                'input_format' => 'd/m/Y'
            ])

            ->add('submit',SubmitType::class,[
                'label' => 'Envoyer'
            ])
         
            ->getForm();
          
           
            $formulaire->handleRequest($request);
       
            if($formulaire->isSubmitted() && $formulaire->isValid()){
          
                $entityManager->persist($eleve);
                $entityManager->flush();

                return $this->redirectToRoute('accueil');
            }else{
                return $this->render('college/ajouterEleve.html.twig',[
                    'type' => 'Eleve',
                    'formView' => $formulaire->createView()
                ]);
            
            }

    }



      /**
     * @Route("/ajouterNote", name="ajouterNote")
     */
    public function createNote(Request $request, EntityManagerInterface $entityManager){
        $note = new Note;
      
        $formulaire = $this->createFormBuilder($note)
            ->add('eleve',EntityType::class,[
                'class' => Eleve::class,
                'choice_label'=> 'nom',
                'label' => 'Eleve'
            ])

            ->add('matiere',EntityType::class,[
                'class' => Matiere::class,
                'choice_label'=> 'nom',
                'label' => 'Matiere'
            ])

            ->add('note',TextType::class,[
                'label' => 'Note'
            ])
            ->add('coefficient',TextType::class,[
                'label' => 'Coefficient'
            ])
            ->add('date',DateType::class,[
                'label'=> "Date de l'épreuve",
                'input_format' => 'd/m/Y'
            ])

            ->add('submit',SubmitType::class,[
                'label' => 'Envoyer'
            ])
         
            ->getForm();
          
           
            $formulaire->handleRequest($request);
       
            if($formulaire->isSubmitted() && $formulaire->isValid()){
          
                $entityManager->persist($note);
                $entityManager->flush();

                return $this->redirectToRoute('accueil');
            }else{
                return $this->render('college/ajouterNote.html.twig',[
                    'type' => 'Note',
                    'formView' => $formulaire->createView()
                ]);
            
            }

        }

         
}
