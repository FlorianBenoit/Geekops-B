<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UnityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UnityRepository::class)
 */
class Unity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"wod_list", "wod_read", "wod_create","exercices_list", "unity_list"})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Exercice::class, mappedBy="unity", orphanRemoval=true)
    
     */
    private $exercices;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"wod_list", "wod_read", "wod_create","exercices_list", "unity_list"})
     */
    private $name;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $exercice->setUnity($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): self
    {
        if ($this->exercices->removeElement($exercice)) {
            // set the owning side to null (unless already changed)
            if ($exercice->getUnity() === $this) {
                $exercice->setUnity(null);
            }
        }

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
}
