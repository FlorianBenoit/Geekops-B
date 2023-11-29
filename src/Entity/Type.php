<?php

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"wod_list", "wod_read", "wod_create", "type_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"wod_list", "wod_read", "type_list"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Wod::class, mappedBy="type")
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
            $wod->setType($this);
        }

        return $this;
    }

    public function removeWod(Wod $wod): self
    {
        if ($this->wods->removeElement($wod)) {
            // set the owning side to null (unless already changed)
            if ($wod->getType() === $this) {
                $wod->setType(null);
            }
        }

        return $this;
    }
}
