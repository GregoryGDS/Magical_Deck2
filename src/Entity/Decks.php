<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DecksRepository")
 */
class Decks
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="listDecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CardDeck", mappedBy="idDeck", orphanRemoval=true)
     */
    private $cardDecks;

    public function __construct()
    {
        $this->cardDecks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?Users
    {
        return $this->idUser;
    }

    public function setIdUser(?Users $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
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
     * @return Collection|CardDeck[]
     */
    public function getCardDecks(): Collection
    {
        return $this->cardDecks;
    }

    public function addCardDeck(CardDeck $cardDeck): self
    {
        if (!$this->cardDecks->contains($cardDeck)) {
            $this->cardDecks[] = $cardDeck;
            $cardDeck->setIdDeck($this);
        }

        return $this;
    }

    public function removeCardDeck(CardDeck $cardDeck): self
    {
        if ($this->cardDecks->contains($cardDeck)) {
            $this->cardDecks->removeElement($cardDeck);
            // set the owning side to null (unless already changed)
            if ($cardDeck->getIdDeck() === $this) {
                $cardDeck->setIdDeck(null);
            }
        }

        return $this;
    }

}
