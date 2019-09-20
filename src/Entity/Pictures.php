<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PicturesRepository")
 */
class Pictures
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
#_____________________________________
    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * @ORM\OneToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    protected $media;
    /**
     * @param MediaInterface $media
     */
    public function setMedia(MediaInterface $media)
    {
        $this->media = $media;
    }
    /**
     * @return MediaInterface
     */
    public function getMedia()
    {
        return $this->media;
    }
    public function getpath()
    {
        return $this->media->getPicturePath();
    }
    
#_________________________________________________

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="pictures", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

}
