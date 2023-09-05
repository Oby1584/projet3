<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin')]

class MembreController extends AbstractController
{
    #[Route('/membre/modifier/{id}', name:"modifier_membre")]
    public function form(Request $request, EntityManagerInterface $manager, Membre $membre , SluggerInterface $slugger): Response
    {
        // $editMode = ($membre->getId() !== null);
        $form = $this->createForm(MembreType::class, $membre);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
        
            $manager->persist($membre);

            $manager->flush();

            
            return $this->redirectToRoute('indexMembre');
        }

        return $this->render('membre/modifier.html.twig', [
            'formMembre' => $form,
            // 'editMode' =>$membre->getId() !== null,
        ]);
    }


    #[Route('/membre/indexMembre', name: 'indexMembre')]
    public function indexMembre(MembreRepository $repo)
    {
        $indexMembre = $repo->findAll();

        return $this->render('membre/index.html.twig', [
            'indexMembre'=> $indexMembre
            
        ]);
    }

    #[Route('/membre/supprimer/{id}', name: 'supprimer_membre')]
     public function supprimer(Membre $membre, EntityManagerInterface $manager)
     {
        $manager->remove($membre);
        $manager->flush();
        return $this->redirectToRoute('indexMembre');


     }


     #[Route('/membre/voir/{id}', name:"voir_membre")]
     public function show($id,MembreRepository $repo)
     {
         $indexMembre = $repo->find($id) ;
         return $this->render('membre/index.html.twig', [
            'indexMembre'=> $indexMembre
            
        ]);
     }
}
