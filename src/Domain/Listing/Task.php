<?php

namespace App\Domain\Listing;

class Task
{
    /**
     * @var string|null
     */
    private $title;

    /**
     * @return  string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param  string|null  $title
     * @return  self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }
}
