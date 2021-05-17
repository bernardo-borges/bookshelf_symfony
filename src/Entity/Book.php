<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_pages;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pages_read;

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

    public function getMaxPages(): ?int
    {
        return $this->max_pages;
    }

    public function setMaxPages(int $max_pages): self
    {
        $this->max_pages = $max_pages;

        return $this;
    }

    public function getPagesRead(): ?int
    {
        return $this->pages_read;
    }

    public function setPagesRead(?int $pages_read): self
    {
        $this->pages_read = $pages_read;

        return $this;
    }
}
