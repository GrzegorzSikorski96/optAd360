<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private string $name;

    /**
     * @ORM\ManyToMany(targetEntity=Site::class, inversedBy="tags", cascade={"persist"})
     */
    private Collection $site;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->site = new ArrayCollection();
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
     * @return Collection|Site[]
     */
    public function getSite(): Collection
    {
        return $this->site;
    }

    /**
     * @param Site $site
     * @return $this
     */
    public function addSite(Site $site): self
    {
        if (!$this->site->contains($site)) {
            $this->site[] = $site;
        }

        return $this;
    }

    /**
     * @param Site $site
     * @return $this
     */
    public function removeSite(Site $site): self
    {
        if ($this->site->contains($site)) {
            $this->site->removeElement($site);
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
