<?php


namespace App\Controller;


use App\Entity\Magasin;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Contact;

class AdminController extends AbstractController
{
    /**
     * List all candidacies
     *
     * @param Request $request the Symfony request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // On récupère toutes les candidatures via le findAll
        // Qui retourne un tableau de Candidacy
        $candidacies = $this->getDoctrine()->getRepository(Contact::class)->findAll();
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        $magasins = $this->getDoctrine()->getRepository(Magasin::class)->findAll();

        return $this->render("admin.html.twig", [
            'candidacies' => $candidacies,
            'produits' => $produits,
            'magasins' => $magasins,

        ]);
    }

    public function suppr(Request $request, $id)
    {
        $candidacy = $this->getDoctrine()->getRepository(Contact::class)->findOneBy([ 'id' => $id ]);
        if (!$candidacy)
        {
            // On lance une 404
            throw $this->createNotFoundException("Candidacy not find with this id : ".$id);
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
            "L'utilisateur n°".$id." a bien été supprimé"
        );
        return $this->redirectToRoute("admins",[]);
    }

    public function chang1(Request $request, $id)
    {
// On utilise le findOneBy, car si on utilise le getOneById l'état ne sera jamais modifié
// Pourquoi ? Tout simplement car dans getOneById on fait un Select partiel récupérant que l'id
// Et doctrine va charger uniquement l'id dans l'objet. Ce qui a pour conséquence que le state
// n'est pas connu de doctrine et donc ne sera pas pris en compte à la modification.
// Essayez de mettre getOneById($id) à la place de findOneBy(['id' => $id])
// Et vous verrez que le state ne se modifiera pas sur une candidature en attente.
        $candidacy = $this->getDoctrine()->getRepository(Contact::class)->findOneBy(['id' => $id]);
        if (!$candidacy)
        {
            // On lance une 404
            throw $this->createNotFoundException("Candidacy not find with this id : ".$id);
        }

        // On modifie l'état de la candidature en accepté
        $candidacy->setRole("Utilisateur");

        $entityManager = $this->getDoctrine()->getManager();

        // On demande à ce que cette candidature soit modifiée au flush
        $entityManager->persist($candidacy);

        // On execute totues les demandes
        $entityManager->flush();

        // Message flash qui sera consommé via le code dans layout.html.twig
        $this->get('session')->getFlashBag()->set(
            'success',
            "Le role de l'administrateur n°".$id." a bien été changé, il est désormais utilisateur"
        );


        return $this->redirectToRoute("admins", []);
    }

    public function chang2(Request $request, $id)
    {
// On utilise le findOneBy, car si on utilise le getOneById l'état ne sera jamais modifié
// Pourquoi ? Tout simplement car dans getOneById on fait un Select partiel récupérant que l'id
// Et doctrine va charger uniquement l'id dans l'objet. Ce qui a pour conséquence que le state
// n'est pas connu de doctrine et donc ne sera pas pris en compte à la modification.
// Essayez de mettre getOneById($id) à la place de findOneBy(['id' => $id])
// Et vous verrez que le state ne se modifiera pas sur une candidature en attente.
        $candidacy = $this->getDoctrine()->getRepository(Contact::class)->findOneBy(['id' => $id]);
        if (!$candidacy)
        {
            // On lance une 404
            throw $this->createNotFoundException("Candidacy not find with this id : ".$id);
        }

        // On modifie l'état de la candidature en accepté
        $candidacy->setRole("Admin");

        $entityManager = $this->getDoctrine()->getManager();

        // On demande à ce que cette candidature soit modifiée au flush
        $entityManager->persist($candidacy);

        // On execute totues les demandes
        $entityManager->flush();

        // Message flash qui sera consommé via le code dans layout.html.twig
        $this->get('session')->getFlashBag()->set(
            'success',
            "Le role de l'utilisateur n°".$id." a bien été changé, il est désormais administrateur"
        );


        return $this->redirectToRoute("admins", []);
    }

}
