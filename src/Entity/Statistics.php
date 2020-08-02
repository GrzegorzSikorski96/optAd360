<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\StatisticsRepository;
use DateTime;
use DateTimeInterface;
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
    private int $id;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $date;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private string $estimated_revenue;

    /**
     * @ORM\Column(type="integer")
     */
    private int $ad_impressions;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private string $ad_ecpm;

    /**
     * @ORM\Column(type="integer")
     */
    private int $clicks;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private string $ad_ctr;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="statistics")
     * @ORM\JoinColumn(nullable=false)
     */
    private Site $site;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return $this
     */
    public function setDate(DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getRevenue(): string
    {
        return $this->estimated_revenue;
    }

    /**
     * @param string $revenue
     * @return $this
     */
    public function setRevenue(string $revenue): self
    {
        $this->estimated_revenue = $revenue;

        return $this;
    }

    /**
     * @return int
     */
    public function getImpression(): int
    {
        return $this->ad_impressions;
    }

    /**
     * @param int $impression
     * @return $this
     */
    public function setImpression(int $impression): self
    {
        $this->ad_impressions = $impression;

        return $this;
    }

    /**
     * @return string
     */
    public function getEcpm(): string
    {
        return $this->ad_ecpm;
    }

    /**
     * @param string $ecpm
     * @return $this
     */
    public function setEcpm(string $ecpm): self
    {
        $this->ad_ecpm = $ecpm;

        return $this;
    }

    /**
     * @return int
     */
    public function getClicks(): int
    {
        return $this->clicks;
    }

    /**
     * @param int $clicks
     * @return $this
     */
    public function setClicks(int $clicks): self
    {
        $this->clicks = $clicks;

        return $this;
    }

    /**
     * @return string
     */
    public function getCtr(): string
    {
        return $this->ad_ctr;
    }

    /**
     * @param string $ctr
     * @return $this
     */
    public function setCtr(string $ctr): self
    {
        $this->ad_ctr = $ctr;

        return $this;
    }

    /**
     * @return Site
     */
    public function getSite(): Site
    {
        return $this->site;
    }

    /**
     * @param Site $site
     * @return $this
     */
    public function setSite(Site $site): self
    {
        $this->site = $site;

        return $this;
    }
}
