<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
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
     * @var string|null
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prixht", type="string", length=50, nullable=true)
     */
    private $prixht;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stock", type="string", length=50, nullable=true)
     */
    private $stock;

    /**
     * @var string|null
     *
     * @ORM\Column(name="anne", type="string", length=11, nullable=true)
     */
    private $anne;
    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=true)
     */
    private $type;
    /**
     * @var string|null
     *
     * @ORM\Column(name="realisateur", type="string", length=50, nullable=true)
     */
    private $realisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string|null
     *
     * @ORM\Column(name="affiche", type="string", length=255, nullable=true)
     */
    private $affiche;





    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?string $id){
        $this->id = $id;
        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixht(): ?string
    {
        return $this->prixht;
    }

    public function setPrixht(?string $prixht): self
    {
        $this->prixht = $prixht;

        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(?string $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAnne(): ?string
    {
        return $this->anne;
    }

    /**
     * @param string|null $anne
     */
    public function setAnne(?string $anne): void
    {
        $this->anne = $anne;
    }



    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    /**
     * @param string|null $realisateur
     */
    public function setRealisateur(?string $realisateur): void
    {
        $this->realisateur = $realisateur;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string|null
     */
    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    /**
     * @param string|null $affiche
     */
    public function setAffiche(?string $affiche): void
    {
        $this->affiche = $affiche;
    }



}
