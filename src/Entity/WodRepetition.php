<?php

namespace App\Entity;

use App\Repository\WodRepetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Wod;

/**
 * @ORM\Entity(repositoryClass=WodRepetitionRepository::class)
 */
class WodRepetition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"wod_list", "wod_read", "wod_create", "wod_rep_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"wod_list", "wod_read", "wod_rep_list"})
     */
    private $repetition;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"wod_list", "wod_read", "wod_rep_list"})
     */
    private $time;

    /**
     * @ORM\OneToMany(targetEntity=Wod::class, mappedBy="repetition", orphanRemoval=true)
     */
    private $wods;


    public function __construct()
    {
        $this->wods = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRepetition(): ?int
    {
        return $this->repetition;
    }

    public function setRepetition(?int $repetition): self
    {
        $this->repetition = $repetition;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(?int $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return Collection<int, Wod>
     */
    public function getWods(): Collection
    {
        return $this->wods;
    }

    public function addWod(Wod $wod): self
    {
        if (!$this->wods->contains($wod)) {
            $this->wods[] = $wod;
            $wod->setRepetition($this);
        }

        return $this;
    }

    public function removeWod(Wod $wod): self
    {
        if ($this->wods->removeElement($wod)) {
            // set the owning side to null (unless already changed)
            if ($wod->getRepetition() === $this) {
                $wod->setRepetition(null);
            }
        }

        return $this;
    }

   

}
