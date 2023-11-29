<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"wod_list", "wod_read", "wod_create", "category_list", "activity_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"wod_list", "wod_read", "exercices_list", "category_list", "activity_list"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Wod::class, mappedBy="category")
     */
    private $wods;

    /**
     * @ORM\OneToMany(targetEntity=Activity::class, mappedBy="category", orphanRemoval=true)
     */
    private $activities;


    public function __construct()
    {
        $this->wods = new ArrayCollection();
        $this->activities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $wod->setCategory($this);
        }

        return $this;
    }

    public function removeWod(Wod $wod): self
    {
        if ($this->wods->removeElement($wod)) {
            // set the owning side to null (unless already changed)
            if ($wod->getCategory() === $this) {
                $wod->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Activity>
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setCategory($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getCategory() === $this) {
                $activity->setCategory(null);
            }
        }

        return $this;
    }
}
