<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\SanctionRepository")]
class Sanction {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\ManyToOne(targetEntity: Etudiant::class, inversedBy: "sanctions")]
    #[ORM\JoinColumn(nullable: false)]
    private $etudiant;

    #[ORM\ManyToOne(targetEntity: Professeur::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $professeur;

    #[ORM\Column(type: "date")]
    private $date;

    #[ORM\Column(type: "string", length: 255)]
    private $raison;

    #[ORM\Column(type: "text")]
    private $description;

    // Getters et Setters
    // ...

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;
        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): self
    {
        $this->professeur = $professeur;
        return $this;
    }

    public function __toString()
    {
        return $this->description;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
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

    public function getRaison(): ?string
    {
        return $this->raison;
    }   

    public function setRaison(string $raison): self
    {
        $this->raison = $raison;
        return $this;
    }

}