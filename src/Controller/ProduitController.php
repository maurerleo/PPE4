<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="produit_index", methods={"GET"})
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="produit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }
    public function produitadd(Request $request)
    {

        // Instance du modele
        $produit = new Produit();


        // On force que ce soit le sujet b juste pour le plaisir de modifier le modèle


        // On utilise la méthode createForm de AbstractController
        // qui permet de créer un formulaire à partir d'un namespace d'un type de formulaire
        // et d'une instance du modèle associé
        // Le dernier paramètre [] sont les options du formulaire, qu'on n’utilisera pas
        $form = $this->createForm(ProduitType::class, $produit, []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();
            return $this->redirectToRoute('admins');
        }
        return $this->render("addprod.html.twig", [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="produit_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Produit $produit): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admins');
        }

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Produit $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index');
    }
    public function addPannier(Request $request){

    }
    public function suppr(Request $request, $id)
    {
        $candidacy = $this->getDoctrine()->getRepository(Produit::class)->findOneBy([ 'id' => $id ]);
        if (!$candidacy)
        {
            // On lance une 404
            throw $this->createNotFoundException("Produit not find with this id : ".$id);
        }

        // Si elle existe, on a l'objet php Candidacy de doctrine
        // qui sait que cette objet est lié à notre ligne en base de données

        // On récupère l'entity manager
        $entityManager = $this->getDoctrine()->getManager();

        // On demande à ce que cette candidature soit supprimée au flush
        $entityManager->remove($candidacy);

        // On exécute toutes les demandes (on en a qu'une, notre suppression)
        $entityManager->flush();

        // Message flash qui sera consommé via le code dans layout.html.twig
        $this->get('session')->getFlashBag()->set(
            'success',
            "Le produit n°".$id." a bien été supprimé"
        );
        return $this->redirectToRoute("admins",[]);
    }



    public function webserviceAllp():Response{
        $lesproduits=$this->getDoctrine()->getRepository(Produit::class)->findAll();
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response();
        $response->setContent($serializer->serialize($lesproduits,'json'));
        $response->headers->set('Content-type','application/json');
        return $response;
    }
}
