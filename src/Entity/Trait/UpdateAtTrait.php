<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait UpdateAtTrait
{
    #[ORM\Column]
    private ?\DateTimeImmutable $updateAt = null;

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}