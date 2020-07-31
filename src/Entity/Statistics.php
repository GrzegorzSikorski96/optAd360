<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticsRepository::class)
 */
class Statistics
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $revenue;

    /**
     * @ORM\Column(type="integer")
     */
    private $impression;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $ecpm;

    /**
     * @ORM\Column(type="integer")
     */
    private $clicks;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $ctr;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="statistics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $site;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRevenue(): ?string
    {
        return $this->revenue;
    }

    public function setRevenue(string $revenue): self
    {
        $this->revenue = $revenue;

        return $this;
    }

    public function getImpression(): ?int
    {
        return $this->impression;
    }

    public function setImpression(int $impression): self
    {
        $this->impression = $impression;

        return $this;
    }

    public function getEcpm(): ?string
    {
        return $this->ecpm;
    }

    public function setEcpm(string $ecpm): self
    {
        $this->ecpm = $ecpm;

        return $this;
    }

    public function getClicks(): ?int
    {
        return $this->clicks;
    }

    public function setClicks(int $clicks): self
    {
        $this->clicks = $clicks;

        return $this;
    }

    public function getCtr(): ?string
    {
        return $this->ctr;
    }

    public function setCtr(string $ctr): self
    {
        $this->ctr = $ctr;

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }
}
