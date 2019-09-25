<?php

namespace App\Entity;

use App\Application\Sonata\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\MediaInterface;



/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
#________________________________________________________________________________________
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     */
    private $category;
    public function getCategory():?Category
    {
        return $this->category;
    }
    public function setCategory($category):?Category
    {
        return $this->category = $category;
    }
#________________________________________________________________________________________
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
#________________________________________________________________________________________
    /**
     * @ORM\Column(type="text")
     */
    private $body;
    public function getBody(): ?string
    {
        return $this->body;
    }
    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }
#______________________________________Paragraphs______________________________
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Paragraph", cascade="persist", mappedBy="article")
     */
    private $paragraphs;

    public function __construct()
    {
        $this->paragraphs = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }
    /**
     * @return Collection|Paragraph[]
     */
    public function getParagraphs(): Collection
    {
        return $this->paragraphs;
    }
    public function addParagraph(Paragraph $paragraph): self
    {
        if (!$this->paragraphs->contains($paragraph)) {
            $this->paragraphs[] = $paragraph;
            $paragraph->setArticle($this);
        }

        return $this;
    }
    public function removeParagraph(Paragraph $paragraph): self
    {
        if ($this->paragraphs->contains($paragraph)) {
            $this->paragraphs->removeElement($paragraph);
            // set the owning side to null (unless already changed)
            if ($paragraph->getArticle() === $this) {
                $paragraph->setArticle(null);
            }
        }

        return $this;
    }
#________________________________Pictures_________________________________________
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pictures", mappedBy="article", cascade={"persist"}, fetch="LAZY")
     */
    private $pictures;

    /**
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\UserBundle\Entity\User", inversedBy="article")
     */
    private $user;

    /**
     * @return Collection|Pictures[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setArticle($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getArticle() === $this) {
                $picture->setArticle(null);
            }
        }

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
