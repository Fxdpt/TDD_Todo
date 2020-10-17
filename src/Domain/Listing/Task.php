<?php

namespace App\Domain\Listing;

class Task
{
    /**
     * @var string|null
     */
    private $title;

    /**
     * @var string|null
     */
    private $parentId;

    /**
     * @var string|null
     */
    private $description;

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
        if ($title === null) {
            throw new TaskException("Title can't be empty");
        }
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    /**
     * @param string|null $parentId
     * @return self
     */
    public function setParentId(?string $parentId): self
    {
        if ($parentId === null) {
            throw new TaskException("Parent Id can't be empty");
        }
        $this->parentId = $parentId;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
}
