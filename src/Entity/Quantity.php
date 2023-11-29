<?php

namespace App\Entity;


use App\Entity\Exercice;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuantityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=QuantityRepository::class)
 */
class Quantity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"wod_list", "wod_read", "wod_create","exercices_list", "quantities_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"wod_list", "wod_read", "wod_create","exercices_list", "quantities_list"})
     */
    private $number;

    /**
     * @ORM\OneToMany(targetEntity=Exercice::class, mappedBy="quantity", orphanRemoval=true)
     */
    private $exercices;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): self
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices[] = $exercice;
            $exercice->setQuantity($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): self
    {
        if ($this->exercices->removeElement($exercice)) {
            // set the owning side to null (unless already changed)
            if ($exercice->getQuantity() === $this) {
                $exercice->setQuantity(null);
            }
        }

        return $this;
    }
}
