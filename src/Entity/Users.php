<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cards", mappedBy="id_creator", orphanRemoval=true)
     */
    private $listCards;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Decks", mappedBy="idUser", orphanRemoval=true)
     */
    private $listDecks;

    public function __construct()
    {
        $this->listCards = new ArrayCollection();
        $this->roles = ['ROLE_USER'];
        $this->listDecks = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self 
    { 
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //$roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $listCard->setIdCreator($this);
        }

        return $this;
    }

    public function removeListCard(Cards $listCard): self
    {
        if ($this->listCards->contains($listCard)) {
            $this->listCards->removeElement($listCard);
            // set the owning side to null (unless already changed)
            if ($listCard->getIdCreator() === $this) {
                $listCard->setIdCreator(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string 
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string 
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface 
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return Collection|Decks[]
     */
    public function getListDecks(): Collection
    {
        return $this->listDecks;
    }

    public function addListDeck(Decks $listDecks): self
    {
        if (!$this->listDecks->contains($listDecks)) {
            $this->listDecks[] = $listDecks;
            $listDecks->setIdUser($this);
        }

        return $this;
    }

    public function removeListDeck(Decks $listDecks): self
    {
        if ($this->listDecks->contains($listDecks)) {
            $this->listDecks->removeElement($listDecks);
            // set the owning side to null (unless already changed)
            if ($listDecks->getIdUser() === $this) {
                $listDecks->setIdUser(null);
            }
        }

        return $this;
    }

    public function arrayExport(){

        $exportTab = [
            "prenom" => $this->getFirstName(),
            "nom" => $this->getLastName(),
            "email" => $this->getEmail(),
            'date_creation'=> $this->getCreatedDate()->format('d-m-Y H:i:s')
        ];
        //ajout role
        return $exportTab;
    }
}
