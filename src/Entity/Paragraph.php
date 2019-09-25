<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParagraphRepository")
 */
class Paragraph
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
#___________________________Content___________________________

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
#___________________________Article__________________________

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", cascade="persist", inversedBy="paragraphs")
     * 
     */
    private $article;

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
