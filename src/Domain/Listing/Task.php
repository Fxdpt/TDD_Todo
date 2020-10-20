<?php

namespace App\Domain\Listing;

use App\Domain\Category\Category;

class Task
{
    public const STATUS_TODO = 'TODO';
    public const STATUS_IN_PROGRESS = 'IN PROGRESS';
    public const STATUS_BLOCKED = 'BLOCKED';
    public const STATUS_DONE = 'DONE';

    public const AVAILABLE_STATUS = [
        self::STATUS_TODO,
        self::STATUS_IN_PROGRESS,
        self::STATUS_BLOCKED,
        self::STATUS_DONE
    ];

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
     * @var Category|null
     */
    private $category;

    /**
     * @var string|null
     */
    private $status;

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

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     * @return self
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @param string|null $status
     * @return self
     */
    public function setStatus(?string $status): self
    {
        if ($status === null || !in_array($status, self::AVAILABLE_STATUS)) {
            throw new TaskException('Invalid status');
        }
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }
}
