<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SiteRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $url;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="sites")
     * @ORM\JoinColumn(nullable=false)
     */
    private Company $company;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, mappedBy="site")
     */
    private Collection $tags;

    /**
     * @ORM\OneToMany(targetEntity=Statistics::class, mappedBy="site", orphanRemoval=true)
     */
    private Collection $statistics;

    /**
     * Site constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->statistics = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return $this
     */
    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addSite($this);
        }

        return $this;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeSite($this);
        }

        return $this;
    }

    /**
     * @param string $date
     * @return Statistics
     */
    public function getDateStatistics(string $date): ?Statistics
    {
        return $this->getStatistics()
            ->filter(function (Statistics $statistics) use ($date) {
                return $statistics->getDate() == new DateTime($date);
            })
            ->first() ?: null;
    }

    /**
     * @return Collection|Statistics[]
     */
    public function getStatistics(): Collection
    {
        return $this->statistics;
    }

    /**
     * @param Statistics $statistic
     * @return $this
     */
    public function addStatistic(Statistics $statistic): self
    {
        if (!$this->statistics->contains($statistic)) {
            $this->statistics[] = $statistic;
            $statistic->setSite($this);
        }

        return $this;
    }

    /**
     * @param Statistics $statistic
     * @return $this
     */
    public function removeStatistic(Statistics $statistic): self
    {
        if ($this->statistics->contains($statistic)) {
            $this->statistics->removeElement($statistic);
            // set the owning side to null (unless already changed)
            if ($statistic->getSite() === $this) {
                $statistic->setSite(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
