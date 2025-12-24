<?php

namespace App\Entity;

use App\Repository\ChiffreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChiffreRepository::class)]
class Chiffre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $adherente = null;

    #[ORM\Column(nullable: true)]
    private ?int $certifiee = null;

    #[ORM\Column(nullable: true)]
    private ?bool $actif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdherente(): ?int
    {
        return $this->adherente;
    }

    public function setAdherente(?int $adherente): static
    {
        $this->adherente = $adherente;

        return $this;
    }

    public function getCertifiee(): ?int
    {
        return $this->certifiee;
    }

    public function setCertifiee(?int $certifiee): static
    {
        $this->certifiee = $certifiee;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }
}
