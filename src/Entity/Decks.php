<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\CardDeck", inversedBy="idDeck")
     */
    private $cardDeck;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="listDecks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

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

    public function getCardDeck(): ?CardDeck
    {
        return $this->cardDeck;
    }

    public function setCardDeck(?CardDeck $cardDeck): self
    {
        $this->cardDeck = $cardDeck;

        return $this;
    }

}
