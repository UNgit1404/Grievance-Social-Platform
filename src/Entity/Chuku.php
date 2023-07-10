<?php

namespace App\Entity;

use App\Repository\ChukuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChukuRepository::class)]
class Chuku
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Habbits = null;

    #[ORM\Column(length: 255)]
    private ?string $Mood = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHabbits(): ?string
    {
        return $this->Habbits;
    }

    public function setHabbits(string $Habbits): self
    {
        $this->Habbits = $Habbits;

        return $this;
    }

    public function getMood(): ?string
    {
        return $this->Mood;
    }

    public function setMood(string $Mood): self
    {
        $this->Mood = $Mood;

        return $this;
    }
}
