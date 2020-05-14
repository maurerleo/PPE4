<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Panier
 *
 * @ORM\Table(name="lepanier")
 * @ORM\Entity(repositoryClass="App\Repository\LePanierRepository")
 */
class LePanier
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
     * @ORM\Column(name="idProduit", type="string", length=255, nullable=true)
     */
    private $idProduit;
    /**
     * @var string|null
     *
     * @ORM\Column(name="idContact", type="string", length=255, nullable=true)
*/
    private $idConcact;

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
     * @return string|null
     */
    public function getIdProduit(): ?string
    {
        return $this->idProduit;
    }

    /**
     * @param string|null $idProduit
     */
    public function setIdProduit(?string $idProduit): void
    {
        $this->idProduit = $idProduit;
    }

    /**
     * @return string|null
     */
    public function getIdConcact(): ?string
    {
        return $this->idConcact;
    }

    /**
     * @param string|null $idConcact
     */
    public function setIdConcact(?string $idConcact): void
    {
        $this->idConcact = $idConcact;
    }





}