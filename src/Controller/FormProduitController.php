<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManager;
use App\Repository\ProduitRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]

class FormProduitController extends AbstractController
{
    
    #[Route('/produit/modifier/{id}', name:"modifier")]
    #[Route('/form/produit', name: 'formulaireProduit')]
    public function form(Request $request, EntityManagerInterface $manager, Produit $produit = null, SluggerInterface $slugger): Response
    {if($produit == null)
        {
            $produit = new Produit;  
        }
        // $editMode = ($produit->getId() !== null);
        
        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
        
            $produit->setDateEnregistrement(new \DateTime());
            $manager->persist($produit);

            $manager->flush();

            
            return $this->redirectToRoute('fichier');
        }

        return $this->render('form_produit/index.html.twig', [
            'formProduit' => $form,
            'editMode' =>$produit->getId() !== null,
        ]);
    }


    #[Route('/produit/fichier', name: 'fichier')]
    public function fichier(ProduitRepository $repo)
    {
        $fichier = $repo->findAll();

        return $this->render('form_produit/fichier.html.twig', [
            'fichier'=> $fichier
            
        ]);
    }

    #[Route('/produit/supprimer/{id}', name: 'supprimer')]
     public function supprimer(Produit $produit, EntityManagerInterface $manager)
     {
        $manager->remove($produit);
        $manager->flush();
        return $this->redirectToRoute('fichier');


     }

}
