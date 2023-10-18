<?php

namespace App\Entity;

use App\Repository\MineralRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MineralRepository::class)]
class Mineral
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column]
    private ?int $densidad = null;

    #[ORM\Column]
    private ?int $valor = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cristalizacion $cristalizacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getDensidad(): ?int
    {
        return $this->densidad;
    }

    public function setDensidad(int $densidad): static
    {
        $this->densidad = $densidad;

        return $this;
    }

    public function getValor(): ?int
    {
        return $this->valor;
    }

    public function setValor(int $valor): static
    {
        $this->valor = $valor;

        return $this;
    }

    public function getCristalizacion(): ?Cristalizacion
    {
        return $this->cristalizacion;
    }

    public function setCristalizacion(?Cristalizacion $cristalizacion): static
    {
        $this->cristalizacion = $cristalizacion;

        return $this;
    }
}
