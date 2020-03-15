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
     * @ORM\ManyToOne(targetEntity="App\Entity\Decks", inversedBy="cardDecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idDeck;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cards", inversedBy="cardDecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCard;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDeck(): ?Decks
    {
        return $this->idDeck;
    }

    public function setIdDeck(?Decks $idDeck): self
    {
        $this->idDeck = $idDeck;

        return $this;
    }

    public function getIdCard(): ?Cards
    {
        return $this->idCard;
    }

    public function setIdCard(?Cards $idCard): self
    {
        $this->idCard = $idCard;

        return $this;
    }

}
