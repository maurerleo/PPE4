<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Contact
 *
 * @ORM\Table(name="Contact")
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact implements UserInterface
{


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;


    /**
     * @ORM\Column( name="email", type="string", length=180, unique=true)
     */
    protected $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     */
    protected $firstname;
    /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=50, nullable=true)
     */
    protected $role;
    /**
     * @var string|null
     *
     * @ORM\Column(name="codep", type="string", length=50, nullable=true)
     */
    protected $codep;
    /**
     * @var string|null
     *
     * @ORM\Column(name="rue", type="string", length=50, nullable=true)
     */
    protected $rue;
    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=true)
     */
    protected $ville;
    /**
     * @var string|null
     *
     * @ORM\Column(name="mdp", type="string", length=255, nullable=true)
     */
    protected $mdp;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }



    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getCodep()
    {
        return $this->codep;
    }

    /**
     * @param mixed $codep
     */
    public function setCodep($codep): void
    {
        $this->codep = $codep;
    }

    /**
     * @return mixed
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue): void
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville): void
    {
        $this->ville = $ville;
    }

    /**
     * @return string|null
     */
    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    /**
     * @param string|null $mdp
     */
    public function setMdp(?string $mdp): void
    {
        $this->mdp = $mdp;
    }


    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        $roles = $this->role;
        // guarantee every user at least has ROLE_USER
        $roles = array('ROLE_USER') ;

        return $roles;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
       return $this->mdp;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return (string) $this->email;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
