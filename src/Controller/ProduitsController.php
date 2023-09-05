<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitsController extends AbstractController
{
    #[Route('/produits', name: 'produits')]
    public function index(ProduitRepository $repo): Response
    {
        $produits = $repo->findAll();
        return $this->render('produits/index.html.twig', [
            'produits' => $produits
        ]);
    }


    
    #[Route('/produits/voir/{id}', name:"voir")]
    public function show($id,ProduitRepository $repo)
    {
        $produits = $repo->find($id) ;
        return $this->render('produits/voir.html.twig',[
            'produits' => $produits
        ]);
    }




}
