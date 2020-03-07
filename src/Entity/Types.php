<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypesRepository")
 */
class Types
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
     * @ORM\OneToMany(targetEntity="App\Entity\Cards", mappedBy="id_type")
     */
    private $listCards;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $cardColor;

    public function __construct()
    {
        $this->listCards = new ArrayCollection();
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

    /**
     * @return Collection|Cards[]
     */
    public function getListCards(): Collection
    {
        return $this->listCards;
    }

    public function addListCard(Cards $listCard): self
    {
        if (!$this->listCards->contains($listCard)) {
            $this->listCards[] = $listCard;
            $listCard->setIdType($this);
        }

        return $this;
    }

    public function removeListCard(Cards $listCard): self
    {
        if ($this->listCards->contains($listCard)) {
            $this->listCards->removeElement($listCard);
            // set the owning side to null (unless already changed)
            if ($listCard->getIdType() === $this) {
                $listCard->setIdType(null);
            }
        }

        return $this;
    }

    public function getCardColor(): ?string
    {
        return $this->cardColor;
    }

    public function setCardColor(?string $cardColor): self
    {
        $this->cardColor = $cardColor;

        return $this;
    }
}
