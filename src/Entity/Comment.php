<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"wod_list", "wod_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Groups({"wod_list", "wod_read"})
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Wod::class, inversedBy="comment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $wod;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

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
