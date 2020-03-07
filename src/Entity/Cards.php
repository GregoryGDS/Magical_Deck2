<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardsRepository")
 */
class Cards
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $HP;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $attack;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shield;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $cost;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Types", inversedBy="listCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="listCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_creator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Factions", inversedBy="listCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_faction;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CardDeck", inversedBy="idCard")
     */
    private $cardDeck;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHP(): ?int
    {
        return $this->HP;
    }

    public function setHP(?int $HP): self
    {
        $this->HP = $HP;

        return $this;
    }

    public function getAttack(): ?int
    {
        return $this->attack;
    }

    public function setAttack(?int $attack): self
    {
        $this->attack = $attack;

        return $this;
    }

    public function getShield(): ?int
    {
        return $this->shield;
    }

    public function setShield(?int $shield): self
    {
        $this->shield = $shield;

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

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getIdType(): ?Types
    {
        return $this->id_type;
    }

    public function setIdType(?Types $id_type): self
    {
        $this->id_type = $id_type;

        return $this;
    }

    public function getIdCreator(): ?Users
    {
        return $this->id_creator;
    }

    public function setIdCreator(?Users $id_creator): self
    {
        $this->id_creator = $id_creator;

        return $this;
    }

    public function getIdFaction(): ?Factions
    {
        return $this->id_faction;
    }

    public function setIdFaction(?Factions $id_faction): self
    {
        $this->id_faction = $id_faction;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
