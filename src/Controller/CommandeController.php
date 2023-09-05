<?php

namespace App\Controller;

use cs;
use App\Entity\Commande;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(CartService $cs, EntityManagerInterface $manager): Response
    {
        $panier = $cs->getCartWithData('panier', []);

        if($panier === []) {

            return $this->redirectToRoute('accueil');

        }

        foreach($panier as $item ){
            $commande = new Commande; 
            $montant = $item['quantity'] * $item['product']->getPrix();
            $commande->setMembre($this->getUser());
            $commande->setDateEnregistrement(new \DateTime());
            $commande->setVehicule($item['product']);
            $commande->setQuantite($item['quantity']);
            $commande->setEtat('En cours de traitement');
            $commande->setMontant($montant);




            $manager->persist($commande);

            $manager->flush();
        }



        return $this->render('commande/index.html.twig', [
            'dash' => $panier,
        ]);
    }

    #[Route('/commande/afficher', name: 'afficher')]
    public function afficher(CartService $cs, EntityManagerInterface $manager)
    {

        $panier = $cs->getCartWithData('panier', []);


        return $this->render('commande/dash.html.twig', [
            'dash' => $panier,
        ]);
    }


    
}
