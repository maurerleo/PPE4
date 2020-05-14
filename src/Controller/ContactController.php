<?php

// src/Controller/ContactController.php
namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// On importe le modèle et le type qu'on va utiliser

use App\Form\ContactType;
use App\Entity\Contact;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ContactController extends AbstractController
{
    /**
     * My first contact page
     *
     * @param Request $request the Symfony request
     *
     * @return Response
     */
    public function contact(Request $request, UserPasswordEncoderInterface $encoder)
    {

        // Instance du modele
        $contact = new Contact();


        // On force que ce soit le sujet b juste pour le plaisir de modifier le modèle


        // On utilise la méthode createForm de AbstractController
        // qui permet de créer un formulaire à partir d'un namespace d'un type de formulaire
        // et d'une instance du modèle associé
        // Le dernier paramètre [] sont les options du formulaire, qu'on n’utilisera pas
        $form = $this->createForm(ContactType::class, $contact, []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
         //  dump($contact);
         //  dump($encoder->encodePassword($contact, $contact->getMdp()));
         //  die();
            $contact->setMdp($encoder->encodePassword($contact, $contact->getMdp()));
            $entityManager->persist($contact);
            $entityManager->flush();
            return $this->redirectToRoute('lesproduits');
        }


        // On fait la transformation twig en html en passant le formulaire à la vue
        // Néanmoins, on utilise la méthode createView pour que le formulaire passe en mode
        // affichage et soit utilisable dans un twig
        return $this->render("contact.html.twig", [
            'form' => $form->createView(),
        ]);
    }



    public function webserviceByid(Contact $contact):Response{
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response();
        $response->setContent($serializer->serialize($contact,'json'));
        $response->headers->set('Content-type','application/json');
        return $response;
    }



}
