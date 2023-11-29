<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LikeRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LikeRepository::class)
 * @ORM\Table(name="`like`")
 */
class Like
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_likes"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Wod::class, inversedBy="liked")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"list_likes", "create_likes"})
     */
    private $wod;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="likes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"list_likes", "create_likes"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
