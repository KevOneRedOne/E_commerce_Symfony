<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Product;
use App\Form\ContactType;
use App\Form\SearchProductFormType;
use Webmozart\Assert\Assert;
use App\Form\addProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EcommerceController extends AbstractController
{
    #[Route('/', name: 'app_ecommerce')]
    public function index(): Response
    {
        return $this->render('ecommerce/index.html.twig', [
            'controller_name' => 'EcommerceController',
        ]);
    }
    
    #[Route('/product', name: 'app_product')]
    public function product(ProductRepository $repo, Request $request): Response
    {
        $form = $this->createForm(SearchProductFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->get('NAME')->getData();
            $produits = $repo->getProductByName($data);
        } 
        else
        {
            $produits = $repo->findBy(array(),array('NAME' => 'ASC'));
        }



        return $this->render('product/product.html.twig', [
            'produits' => $produits,
            'SearchProductForm'=> $form->createView()
        ]);
    }

    
    #[Route("/contact", name: "app_contact")]
    public function contact(Request $request, EntityManagerInterface $manager, ContactNotification $cn)
    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $contact->setCREATEDAT(new \DateTime());
            $manager->persist($contact);
            $manager->flush();
            $cn->notify($contact);
            $this->addFlash('success', 'Votre message a bien été envoyé !');
            // addflash() permet de créer des messages de notifications
            // elle prend en param le type du msg et le contenu du msg
            return $this->redirectToRoute('app_contact');  // permet de recharger la page et vider les champs du form
        }

        return $this->render("contact/contact.html.twig", [
            'formContact' => $form->createView()
        ]);
    }

    #[Route('/add-product', name: 'app_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(AddProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            

            $entityManager->persist($product);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/addProduct.html.twig', [
            'addProduct' => $form->createView(),
        ]);
    }
}
