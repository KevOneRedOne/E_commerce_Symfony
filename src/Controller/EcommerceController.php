<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Webmozart\Assert\Assert;
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
    public function product(ProductRepository $repo): Response
    {
        $produits = $repo->findBy(array(),array('NAME' => 'ASC'));

        return $this->render('product/product.html.twig', [
            'produits' => $produits,
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
}
