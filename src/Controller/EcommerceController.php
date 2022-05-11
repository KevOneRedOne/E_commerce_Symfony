<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Product;
use App\Entity\User;
use App\Form\ContactType;
use App\Form\SearchProductFormType;
use Webmozart\Assert\Assert;
use App\Form\AddProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Notification\ContactNotification;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class EcommerceController extends AbstractController
{
    #[Route('/', name: 'app_ecommerce')]
    public function index(): Response
    {
        return $this->render('ecommerce/index.html.twig', [
            'controller_name' => 'EcommerceController',
        ]);
    }

    // ----------------------------------------------------------------------------------
    // ----------------------------------Product-----------------------------------------
    // ----------------------------------------------------------------------------------
    
    #[Route('/product', name: 'app_product')]
    public function product(ProductRepository $repo, Request $request): Response
    {
        $form = $this->createForm(SearchProductFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->get('NAME')->getData();
            $product = $repo->getProductByName($data);
        } 
        else
        {
            $product = $repo->findBy(array(),array('NAME' => 'ASC'));
        }

        return $this->render('product/product.html.twig', [
            'produits' => $product,
            'SearchProductForm'=> $form->createView()
        ]);
    }

    #[Route("/product/details/{id}", name:'app_details')]
    public function detailsProduct(Product $product)
    {
        return $this-> render("product/detailsProduct.html.twig", [
            'produits' => $product
        ]);
    }

    // ----------------------------------------------------------------------------------
    // --------------------------------New PRODUCT---------------------------------------
    // ----------------------------------------------------------------------------------

    #[Route('/product/newProduct', name: 'app_newProduct')]
    public function newProduct(Request $request, EntityManagerInterface $entityManager, Product $product=null, ?UserInterface $user): Response
    {
        if (!$product) 
        {
            $product = new Product;
            $product -> setUpdatedAt(new \DateTime());        
        }

        $product = new Product();
        $form = $this->createForm(AddProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUserId($user);
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/newProduct.html.twig', [
            'newProduct' => $form->createView(),
        ]);
    }

    // ----------------------------------------------------------------------------------
    // -----------------------------Edit Product-----------------------------------------
    // ----------------------------------------------------------------------------------

    #[Route('/product/edit/{id}', name: 'app_edit')]
    public function editProduct(Request $request, EntityManagerInterface $entityManager, Product $product=null, ?UserInterface $user): Response
    {
        $form = $this->createForm(AddProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUserId($user);
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('app_details', [
                'id' => $product->getId()
            ]);
        }
        return $this->render('product/editProduct.html.twig', [
            'editProduct' => $form->createView(),
        ]);
    }

    // ----------------------------------------------------------------------------------
    // ----------------------------------PROFIL------------------------------------------
    // ----------------------------------------------------------------------------------

    #[Route("/profil", name:"app_userprofil")]
    public function userProfi(?UserInterface $user)
    {
        return $this->render('profil/user.html.twig', [
            'controller_name' => 'EcommerceController',
            'user' => $user
        ]);
    }




    // ----------------------------------------------------------------------------------
    // ----------------------------------CONTACT-----------------------------------------
    // ----------------------------------------------------------------------------------
    
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
            return $this->redirectToRoute('app_contact'); 
        }

        return $this->render("contact/contact.html.twig", [
            'formContact' => $form->createView()
        ]);
    }
}
