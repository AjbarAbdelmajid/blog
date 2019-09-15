<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="category", orphanRemoval=true)
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }


    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }
    public function setArticles($article): self
    {
        if (!$this->articles->contains($article)){
            $this->articles->add($article);
        }
        return $this;
    }
    public function removeArticles($article): self
    {
        if ($this->articles->contains($article)){
            $this->articles->removeElement($article);
            //remove the category pointer on the article side
            $this->article->setCategory(null);
        }
        return $this;
    }
    

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

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
    public function __toString()
    {
        return $this->name;
    }
}
