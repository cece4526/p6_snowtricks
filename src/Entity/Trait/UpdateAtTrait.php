<?php

namespace App\Entity\Trait;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

trait UpdateAtTrait
{
    #[ORM\Column]
    private ?\DateTimeImmutable $updateAt = null;

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}