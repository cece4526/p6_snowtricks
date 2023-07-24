<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait SlugTrait
{
    #[ORM\Column(type: 'string', length: '255')]
    private ?\DateTimeImmutable $slug = null;

    public function getSlug(): ?\DateTimeImmutable
    {
        return $this->slug;
    }

    public function setSlug(\DateTimeImmutable $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}