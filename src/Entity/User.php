<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="integer",
     *     message="{{ value }} n'est pas un nombre entier."
     * )
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="{{ value }} doit etre une chaine de caractères."
     * )
     * @Assert\Email(
     *     message = "Veuillez renseigner votre adresse mail.",
     *     checkMX = true
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 180,
     *      minMessage = "Votre email est trop court",
     *      maxMessage = "Votre email est trop long"
     * )
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="Role invalide."
     * )
     * @var string
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="{{ value }} doit etre une chaine de caractères."
     * )
     * @Assert\Length(
     *      min = 8,
     *      minMessage = "Votre mot de passe doit faire au moins 8 caracteres",
     * )
     * @var string
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="{{ value }} doit etre une chaine de caractères."
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 180,
     *      minMessage = "Votre prénom est trop court",
     *      maxMessage = "Votre prénom est trop long"
     * )
     * @var string
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="string",
     *     message="{{ value }} doit etre une chaine de caractères."
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 180,
     *      minMessage = "Votre nom est trop court",
     *      maxMessage = "Votre nom est trop long"
     * )
     * @var string
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Property", mappedBy="userProperty")
     */
    private $properties;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     *
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return array
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     * @return User
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     *
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
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
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return string
     */
    public function setName($name): string
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param $lastName
     * @return string
     */
    public function setLastName($lastName): string
    {
        $this->lastName = $lastName;
    }

    /**
     * @return Collection
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    /**
     * @param Property $property
     * @return User
     */
    public function addProperty(Property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setUserProperty($this);
        }

        return $this;
    }

    /**
     * @param Property $property
     * @return User
     */
    public function removeProperty(Property $property): self
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
            // set the owning side to null (unless already changed)
            if ($property->getUserProperty() === $this) {
                $property->setUserProperty(null);
            }
        }

        return $this;
    }
}
