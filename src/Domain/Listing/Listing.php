<?php

namespace App\Domain\Listing;

class Listing
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $title;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var Task[]
     */
    private $tasks;

    /**
     * @return  string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param  string  $id
     * @return  self
     */
    public function setId(?string $id): self
    {
        if ($id === null) {
            throw new ListingException("Id can't be empty");
        }
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return self
     */
    public function setTitle(?string $title): self
    {
        if ($title === null) {
            throw new ListingException("Title can't be empty");
        }
        $this->title = $title;
        return $this;
    }

    /**
     * @return  string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param  string|null  $description
     * @return  self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param Task $task
     * @return self
     */
    public function setTask(Task $task): self
    {
        $this->tasks[] = $task;
        return $this;
    }

    /**
     * @return array<Task>|null
     */
    public function getTasks(): ?array
    {
        return $this->tasks;
    }
}
