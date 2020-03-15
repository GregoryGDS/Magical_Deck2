<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RarityRepository")
 */
class Rarity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cards", mappedBy="rarity", orphanRemoval=true)
     */
    private $idCard;

    public function __construct()
    {
        $this->idCard = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Cards[]
     */
    public function getIdCard(): Collection
    {
        return $this->idCard;
    }

    public function addIdCard(Cards $idCard): self
    {
        if (!$this->idCard->contains($idCard)) {
            $this->idCard[] = $idCard;
            $idCard->setRarity($this);
        }

        return $this;
    }

    public function removeIdCard(Cards $idCard): self
    {
        if ($this->idCard->contains($idCard)) {
            $this->idCard->removeElement($idCard);
            // set the owning side to null (unless already changed)
            if ($idCard->getRarity() === $this) {
                $idCard->setRarity(null);
            }
        }

        return $this;
    }
}
