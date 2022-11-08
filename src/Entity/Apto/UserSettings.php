<?php

namespace App\Entity\Apto;

use App\Repository\Apto\UserSettingsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Cache;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserSettingsRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @Cache(usage="NONSTRICT_READ_WRITE", region="region")
 */
class UserSettings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="userSettings", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Cache(usage="NONSTRICT_READ_WRITE", region="region")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString(): string
    {
        return 'some return';
    }
}
