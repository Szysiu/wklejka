<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'language', targetEntity: Paste::class)]
    private Collection $pastes;

    #[ORM\Column(length: 255)]
    private ?string $tag = null;

    public function __construct()
    {
        $this->pastes = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Paste>
     */
    public function getPastes(): Collection
    {
        return $this->pastes;
    }

    public function addPaste(Paste $paste): self
    {
        if (!$this->pastes->contains($paste)) {
            $this->pastes->add($paste);
            $paste->setLanguage($this);
        }

        return $this;
    }

    public function removePaste(Paste $paste): self
    {
        if ($this->pastes->removeElement($paste)) {
            // set the owning side to null (unless already changed)
            if ($paste->getLanguage() === $this) {
                $paste->setLanguage(null);
            }
        }

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }
}
