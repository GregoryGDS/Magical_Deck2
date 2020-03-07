<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardDeckRepository")
 */
class CardDeck
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cards", mappedBy="cardDeck")
     */
    private $idCard;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Decks", mappedBy="cardDeck")
     */
    private $idDeck;

    public function __construct()
    {
        $this->idCard = new ArrayCollection();
        $this->idDeck = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $idCard->setCardDeck($this);
        }

        return $this;
    }

    public function removeIdCard(Cards $idCard): self
    {
        if ($this->idCard->contains($idCard)) {
            $this->idCard->removeElement($idCard);
            // set the owning side to null (unless already changed)
            if ($idCard->getCardDeck() === $this) {
                $idCard->setCardDeck(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Deck[]
     */
    public function getIdDeck(): Collection
    {
        return $this->idDeck;
    }

    public function addIdDeck(Deck $idDeck): self
    {
        if (!$this->idDeck->contains($idDeck)) {
            $this->idDeck[] = $idDeck;
            $idDeck->setCardDeck($this);
        }

        return $this;
    }

    public function removeIdDeck(Deck $idDeck): self
    {
        if ($this->idDeck->contains($idDeck)) {
            $this->idDeck->removeElement($idDeck);
            // set the owning side to null (unless already changed)
            if ($idDeck->getCardDeck() === $this) {
                $idDeck->setCardDeck(null);
            }
        }

        return $this;
    }
}
