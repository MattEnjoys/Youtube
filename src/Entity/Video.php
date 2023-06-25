<?php

namespace App\Entity;

use App\Entity\Traits\EntityTimeTrait;
use App\Repository\VideoRepository;
use Datetime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    use EntityTimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $thumbnail = null;

    #[ORM\ManyToMany(targetEntity: Playlist::class, inversedBy: 'videos')]
    // 2 - Mettre au pluriel
    private Collection $playlists;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'videos')]
    // 2 - Mettre au pluriel
    private Collection $tags;

    public function __construct()
    {
        // 2 - Mettre au pluriel
        $this->playlists = new ArrayCollection();
        $this->tags = new ArrayCollection();
        // 1- Ajouter par défaut une date d'ajout
        $this->setCreatedAt(new Datetime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    // 2 - Mettre au pluriel
    public function getPlaylists(): Collection
    {
        // 2 - Mettre au pluriel
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): static
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): static
    {
        $this->playlists->removeElement($playlist);

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    // 2 - Mettre au pluriel
    public function getTags(): Collection
    {
        // 2 - Mettre au pluriel
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        // 2 - Mettre au pluriel
        $this->tags->removeElement($tag);

        return $this;
    }
}