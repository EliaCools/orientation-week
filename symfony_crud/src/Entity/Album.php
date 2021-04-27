<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AlbumRepository::class)
 */
class Album
{
    /**
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(min=2)
     * @ORM\Column(type="string", length=255)
     * @ORM\Column(nullable=false)
     */
    private $name;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="datetime")
     * @ORM\Column(nullable=false)
     */
    private $releaseDate;

    /**
     * @Assert\Regex( pattern ="/[a-zA-Z-0-9_&àé' -]/")
     * @Assert\NotBlank
     * @Assert\Length(min=2)
     * @ORM\Column(type="string", length=255)
     * @ORM\Column(nullable=false)
     */
    private $artist;

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

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }
}
