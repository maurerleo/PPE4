<?php


namespace App\DataFixtures;


use App\Entity\User;
use App\Service\UserService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    protected $candidacyService;

    public function __construct(UserService $candidacyService)
    {
        $this->candidacyService = $candidacyService;
    }

    public function load(ObjectManager $entityManager)
    {

        $user = new User();
        $user->setEmail('user@gmail.com');
        // On encode le mot de passe "j_ai_la_banane" dans l'utilisateur
        $user = $this->candidacyService->encodePassword($user, "j_ai_la_banane");
        $this->candidacyService->save($user);

    }
}
