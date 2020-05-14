<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var \Contact
     *
     * @ORM\ManyToOne(targetEntity="Contact")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Contact", referencedColumnName="id")
     * })
     */
    private $id_contact;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Produit", referencedColumnName="id")
     * })
     */
    private $id_produit;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \Contact
     */
    public function getIdContact(): \Contact
    {
        return $this->id_contact;
    }

    /**
     * @param \Contact $id_contact
     */
    public function setIdContact(\Contact $id_contact): void
    {
        $this->id_contact = $id_contact;
    }

    /**
     * @return \Produit
     */
    public function getIdProduit(): \Produit
    {
        return $this->id_produit;
    }

    /**
     * @param \Produit $id_produit
     */
    public function setIdProduit(\Produit $id_produit): void
    {
        $this->id_produit = $id_produit;
    }


}