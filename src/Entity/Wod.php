<?php

namespace App\Entity;

use App\Repository\WodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WodRepository::class)
 */
class Wod
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"wod_list", "wod_read", "wod_create", "list_likes", "create_likes"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"wod_list", "wod_read", "wod_create"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"wod_list", "wod_read", "wod_create"})
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"wod_list", "wod_read", "wod_create"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="wods",  cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"wod_list", "wod_read", "wod_create"})
     */
    private $type;

 

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="wods")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"wod_list", "wod_read", "wod_create"})
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="wod", orphanRemoval=true)
     * @Groups({"wod_list", "wod_read"})
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity=Save::class, mappedBy="wod", orphanRemoval=true)
     */
    private $save;

    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="wod", orphanRemoval=true)
     */
    private $liked;

    /**
     * @ORM\ManyToOne(targetEntity=WodRepetition::class, inversedBy="wods")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"wod_list", "wod_read", "wod_create"})
     */
    private $repetition;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="wods")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity=Exercice::class, mappedBy="wod", orphanRemoval=true,  cascade={"persist"})
     *  @Groups({"wod_list", "wod_read", "wod_create","exercices_list", "unity_list"})
     */
    private $exercices;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"wod_list", "wod_create"})
     */
    private $status;

    public function __construct()
    {
        
        $this->comment = new ArrayCollection();
        $this->save = new ArrayCollection();
        $this->liked = new ArrayCollection();
        $this->exercices = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

   

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }


    /**
     * @return Collection<int, Comment>
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment[] = $comment;
            $comment->setWod($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getWod() === $this) {
                $comment->setWod(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Save>
     */
    public function getSave(): Collection
    {
        return $this->save;
    }

    public function addSave(Save $save): self
    {
        if (!$this->save->contains($save)) {
            $this->save[] = $save;
            $save->setWod($this);
        }

        return $this;
    }

    public function removeSave(Save $save): self
    {
        if ($this->save->removeElement($save)) {
            // set the owning side to null (unless already changed)
            if ($save->getWod() === $this) {
                $save->setWod(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLiked(): Collection
    {
        return $this->liked;
    }

    public function addLiked(Like $liked): self
    {
        if (!$this->liked->contains($liked)) {
            $this->liked[] = $liked;
            $liked->setWod($this);
        }

        return $this;
    }

    public function removeLiked(Like $liked): self
    {
        if ($this->liked->removeElement($liked)) {
            // set the owning side to null (unless already changed)
            if ($liked->getWod() === $this) {
                $liked->setWod(null);
            }
        }

        return $this;
    }

    public function getRepetition(): ?WodRepetition
    {
        return $this->repetition;
    }

    public function setRepetition(?WodRepetition $repetition): self
    {
        $this->repetition = $repetition;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

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
            $exercice->setWod($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): self
    {
        if ($this->exercices->removeElement($exercice)) {
            // set the owning side to null (unless already changed)
            if ($exercice->getWod() === $this) {
                $exercice->setWod(null);
            }
        }

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
   
}
