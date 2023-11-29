<?php

namespace App\Entity;

use App\Entity\Activity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ExerciceRepository::class)
 */
class Exercice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"wod_list", "wod_read", "wod_create", "exercices_list", "repetitions_list", "exercices_infos"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Activity::class, inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"wod_list", "wod_read", "wod_create","exercices_list"})
     */
    private $activity;

    /**
     * @ORM\ManyToOne(targetEntity=Quantity::class, inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"wod_list", "wod_read", "wod_create","exercices_list"})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Unity::class, inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"wod_list", "wod_read", "wod_create","exercices_list"})
     */
    private $unity;

    /**
     * @ORM\ManyToOne(targetEntity=Wod::class, inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $wod;


    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getQuantity(): ?Quantity
    {
        return $this->quantity;
    }

    public function setQuantity(?Quantity $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnity(): ?Unity
    {
        return $this->unity;
    }

    public function setUnity(?Unity $unity): self
    {
        $this->unity = $unity;

        return $this;
    }

    public function getWod(): ?Wod
    {
        return $this->wod;
    }

    public function setWod(?Wod $wod): self
    {
        $this->wod = $wod;

        return $this;
    }

}
