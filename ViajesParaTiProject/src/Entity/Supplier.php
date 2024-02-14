<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: SupplierRepository::class)]
class Supplier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }

    #[ORM\Column]
    #[Assert\NotBlank]
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    #[ORM\Column]
    #[Assert\Email]
    private string $email;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    #[ORM\Column]
    #[Assert\NotBlank]
    #Assert\Lenght(max: 9)
    private string $phone;

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    #[ORM\Column]
    #[Assert\Choice(choices: ['hotel', 'pista', 'complemento'])]
    private string $supplier_type;

    public function getSupplierType(): string
    {
        return $this->supplier_type;
    }

    public function setSupplierType(string $supplier_type): self
    {
        $this->supplier_type = $supplier_type;

        return $this;
    }

    #[ORM\Column(type: 'boolean')]
    private bool $is_active;

    public function getIsActive(): bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function __construct()
    {
        $this->updatedAt = new \DateTime('now', new \DateTimeZone('Europe/Madrid'));
        $this->createdAt = new \DateTime('now', new \DateTimeZone('Europe/Madrid'));
    }
}
