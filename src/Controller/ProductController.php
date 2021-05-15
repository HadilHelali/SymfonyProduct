<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{page<\d+>?1}/{number<\d+>?12}', name: "product")]
    // par défaut 7ot 1 | par défaut 7ot 6
    public function index($page, $number): Response
    {
        // récupérer le repository ( eli fiha toutes les fonctions de selection
        $repository = $this->getDoctrine()->getRepository('App:Product');
        $Products = $repository->findBy([], ['price'=> 'asc'],$number, ($page - 1) * $number);
        //    critère , ordonnée par ordre asc de prix , limite d'enregistrements affichés , à partir d'ou
        return $this->render('product/productList.html.twig', [
            'controller_name' => 'ProductController',
            'Products' => $Products ,
            'Page' => $page ,
            'Number' => $number
        ]);
    }

   // #[Route('/add/{catalogue}/{price<\d+>}', name: "ProductAdd")]
    #[Route('/add/{product?0}', name: "ProductAdd")]
    public function addProduct(/* $catalogue, $price ,*/EntityManagerInterface $manager,Request  $request, Product $product = null): Response
    {
        // 1st Method : To get the EntityManager :
        //   $Manager = $this->getDoctrine()->getManager() ;

        // 2nd Method :
        // EntityManagerInterface $manager : utilise l'injection de dépendance

        // then create the objet :
        /* $Product = new Product();
        $Product->setCatalogue($catalogue);
        $Product->setPrice($price);*/

        // Using the form :
        // create a product :
        if(!$product) {
            $product = new Product();
        }
        // create the form :
        $form = $this->createForm(ProductType::class, $product);
     /*   // then persist the new product : (add it)
        $manager->persist($Product);
        // then excute the request :
        $manager->flush();
        $this->addFlash('success', "The product ".$Product->getCatalogue()." was added successfully"); */
      /*  // direct to the page of the product details
        return $this->redirectToRoute("product"); */
        $form->handleRequest($request); // gérer la requete
        if($form->isSubmitted()) { // b3athna el form wela la
            $manager->persist($product);
            $manager->flush();
            $this->addFlash('success', "le produit ".$product->getCatalogue()." a été ajouté avec succès");
            return $this->redirectToRoute('product');
        }
        return $this->render('product/formAdd.html.twig', [
           'form'=> $form->createView()
        ]);

    }

    #[Route('/update/{Product}/{catalogue}/{price<\d+>}', name: "ProductUpdate")]
    // recupérer le product avec l'id | I have to precise the class of $product
    public function updateProduct(Product $Product = null, $catalogue, $price, EntityManagerInterface $manager): Response
    {
        if ($Product) // si le produit existe
        {
            $Product->setCatalogue($catalogue);
            $Product->setPrice($price);
            // then persist the new product : (add it)
            $manager->persist($Product);
            // then excute the request :
            $manager->flush();
        }
        $this->addFlash('success', "The product".$Product->getCatalogue()." was updated successfully");
        return $this->redirectToRoute("product");
    }

    #[Route('/delete/{Product}', name: "ProductDelete")]
    // recupérer le product avec l'id | I have to precise the class of $product
    public function deleteProduct(Product $Product = null,EntityManagerInterface $manager) : Response
    {
        if ($Product) // si le produit existe
        {   $Name = $Product->getCatalogue();
            // remove the product if it exists :
            $manager->remove($Product);
            // then excute the request :
            $manager->flush();
            // add flach instead on a variable delete !!
         $this->addFlash('success', "The product ".$Name." was removed successfully");
         } else {
        $this->addFlash('error', "The product doesn't exist");}

        return $this->redirectToRoute("product");
    }

    #[Route('/detail/{product}', name: "ProductDetails")]
    public function ProductDetails(Product $product = null): Response
    {
        return $this->render('details.html.twig',['Product'=>$product ]);
    }
}
