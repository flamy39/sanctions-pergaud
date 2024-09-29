<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: "App\Repository\ProfesseurRepository")]
class Professeur {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string")]
    private $nom;

    #[ORM\Column(type: "string")]
    private $prenom;

    #[ORM\OneToMany(targetEntity: Sanction::class, mappedBy: "professeur")]
    private $sanctions;

    public function __construct()
    {
        $this->sanctions = new ArrayCollection();
    }

    // Getters et Setters
    // ...

    /**
     * @return Collection|Sanction[]
     */
    public function getSanctions(): Collection
    {
        return $this->sanctions;
    }

    public function addSanction(Sanction $sanction): self
    {
        if (!$this->sanctions->contains($sanction)) {
            $this->sanctions[] = $sanction;
            $sanction->setProfesseur($this);
        }
        return $this;
    }

    public function removeSanction(Sanction $sanction): self
    {
        if ($this->sanctions->removeElement($sanction)) {
            // set the owning side to null (unless already changed)
            if ($sanction->getProfesseur() === $this) {
                $sanction->setProfesseur(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
       }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }
    
}