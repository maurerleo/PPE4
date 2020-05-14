<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
public function loginAction(AuthenticationUtils $authenticationUtils): Response
{
    dump($this->getUser());

     if ($this->getUser()) {
         return $this->redirectToRoute('lesproduits');
     }

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();
    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();
    dump($lastUsername);

    return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);

  }
 //  public function login(AuthenticationUtils $auth, EntityManagerInterface $em) {
 //      $codes = $em->getRepository(Contact::class)->findAll();
 //      $erreur = $auth->getLastAuthenticationError();
 //      $lastUserName = $auth->getLastUsername();
 //      return $this->render('security/login.html.twig', array('last_username' => $lastUserName, 'error' => $erreur, 'codes' => $codes));


    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */

    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }


}
