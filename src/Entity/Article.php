<?php

namespace App\Entity;

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
#________________________________________________________________________________________
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Paragraph", cascade="persist", mappedBy="article")
     */
    private $paragraphs;

    public function __construct()
    {
        $this->paragraphs = new ArrayCollection();
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
#________________________________________________________________________________________
    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    protected $media;

    /**
     * @param MediaInterface $media
     */
    public function setMedia(MediaInterface $media)
    {
        $this->media = $media;
        return $this;
    }
    /**
     * @return MediaInterface
     */
    public function getMedia()
    {
        return $this->media;
    }

}
