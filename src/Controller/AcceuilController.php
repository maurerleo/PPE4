<?php


namespace App\Controller;
use App\Entity\Contact;
use App\Entity\LePanier;
use App\Entity\Panier;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AcceuilController extends AbstractController
{
 public function index(){
     return $this->render('index.html.twig',[]);
}
public function  pagegen(Request $request){
     $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
     return $this->render('pagegen.html.twig',['product' => $produits]);
}

public function  catalogue(Request $request){
    $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
    return $this->render('catalogue.html.twig',['product' => $produits]);
}
public function panier(Request $request, $id_prod){

    $panier = new LePanier();

     $entityManager = $this->getDoctrine()->getManager();
      $user = $this->getUser()->getId();
      $panier->setIdProduit($id_prod);
      $panier->setIdConcact($user);
      $entityManager->persist($panier);
      $entityManager->flush();


     $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
     return $this->redirectToRoute('lesproduits',['product' => $produits]);

  // $leproduit = $this->getDoctrine()->getRepository(Produit::class)->findOneBy(['id' => $id_prod]);



 // $id_contact = '1';
 //  $panier = new Panier();
 //  $produit = new Produit();
 //  $contact = new Contact();
 //  $contact->setId($id_contact);
 //  $produit->setId($id_prod);



}
public function affichagepanier(Request $request){
    $panier = $this->getDoctrine()->getRepository(LePanier::class)->findBy(['idConcact' => $this->getUser()->getId()]);
    $lesBonsProduits = [];
    foreach ($panier as $leproduit){
        $leBonProduit =  $this->getDoctrine()->getRepository(Produit::class)->findOneBy(['id' => $leproduit->getIdProduit()]);
        array_push($lesBonsProduits,$leBonProduit);


    }

    return $this->render('panier.html.twig',['lepanier' => $lesBonsProduits]);
}
public function supprpanier(Request $request){
    $lespanier = $this->getDoctrine()->getRepository(lePanier::class)->findBy([ 'idConcact' => $this->getUser()->getId() ]);
    if (!$lespanier)
    {
        // On lance une 404
        throw $this->createNotFoundException("Aucun panier ! ");
    }

    // Si elle existe, on a l'objet php Candidacy de doctrine
    // qui sait que cette objet est lié à notre ligne en base de données

    // On récupère l'entity manager
    $entityManager = $this->getDoctrine()->getManager();

    // On demande à ce que cette candidature soit supprimée au flush
    foreach ($lespanier as $panier) {
        $entityManager->remove($panier);
    }
    // On exécute toutes les demandes (on en a qu'une, notre suppression)
    $entityManager->flush();



    return $this->redirectToRoute("lesproduits",[]);

}

public function affichageproduit(Request $request, $id){
     $unproduit =  $this->getDoctrine()->getRepository(Produit::class)->findOneBy([ 'id' => $id ]);;
    if (!$unproduit)
    {
        // On lance une 404
        throw $this->createNotFoundException("Impossible de trouver le produit: ".$id);
    }
    return $this->render("leproduit.html.twig",['leproduit' => $unproduit]);
}


    public function webserviceAll():Response{
        $lesclient=$this->getDoctrine()->getRepository(Contact::class)->findAll();
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $response = new Response();
        $response->setContent($serializer->serialize($lesclient,'json'));
        $response->headers->set('Content-type','application/json');
        return $response;
    }
}