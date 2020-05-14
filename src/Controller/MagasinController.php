<?php

namespace App\Controller;

use App\Entity\Magasin;
use App\Form\MagasinType;
use App\Repository\MagasinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/magasin")
 */
class MagasinController extends AbstractController
{
    /**
     * @Route("/", name="magasin_index", methods={"GET"})
     */
    public function index(MagasinRepository $magasinRepository): Response
    {
        return $this->render('magasin/index.html.twig', [
            'magasins' => $magasinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="magasin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $magasin = new Magasin();
        $form = $this->createForm(MagasinType::class, $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($magasin);
            $entityManager->flush();

            return $this->redirectToRoute('magasin_index');
        }

        return $this->render('magasin/new.html.twig', [
            'magasin' => $magasin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="magasin_show", methods={"GET"})
     */
    public function show(Magasin $magasin): Response
    {
        return $this->render('magasin/show.html.twig', [
            'magasin' => $magasin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="magasin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Magasin $magasin): Response
    {
        $form = $this->createForm(MagasinType::class, $magasin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admins');
        }

        return $this->render('magasin/edit.html.twig', [
            'magasin' => $magasin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="magasin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Magasin $magasin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$magasin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($magasin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('magasin_index');
    }

    public function magadd(Request $request)
    {

        // Instance du modele
        $magasin = new Magasin();


        // On force que ce soit le sujet b juste pour le plaisir de modifier le modèle


        // On utilise la méthode createForm de AbstractController
        // qui permet de créer un formulaire à partir d'un namespace d'un type de formulaire
        // et d'une instance du modèle associé
        // Le dernier paramètre [] sont les options du formulaire, qu'on n’utilisera pas
        $form = $this->createForm(MagasinType::class, $magasin, []);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($magasin);
            $entityManager->flush();
            return $this->redirectToRoute('admins');
        }
        return $this->render("addmagasin.html.twig", [
            'form' => $form->createView(),
        ]);
    }

    public function supprm(Request $request, $id)
    {
        $candidacy = $this->getDoctrine()->getRepository(Magasin::class)->findOneBy([ 'id' => $id ]);
        if (!$candidacy)
        {
            // On lance une 404
            throw $this->createNotFoundException("Magasin not find with this id : ".$id);
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
            "Le Magasin n°".$id." a bien été supprimé"
        );
        return $this->redirectToRoute("admins",[]);
    }




}
